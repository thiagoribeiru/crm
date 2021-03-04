<div id="corpo_new">
    <div id="lead_manual">
        <h1>Novo Lead</h1>
        <form id="form_lead_manual">
            <input type="text" class="novo_lead_input" name="nome" placeholder="Nome" required=required>
            <input type="tel" class="novo_lead_input" name="whatsapp" placeholder="Whatsapp" required=required>
            <input type="mail" class="novo_lead_input" name="email" placeholder="E-mail">
            <select name="campanha" class="novo_lead_select">
                <option value="0">Campanha</option>
                <?
                $campanhasQuery = $sql->query("select * from campanhas order by nome") or die(mysqli_error($sql));
                for($i=0;$i<mysqli_num_rows($campanhasQuery);$i++) {
                    $campanha = mysqli_fetch_array($campanhasQuery);
                    echo "<option value=\"".$campanha['indice']."\">".$campanha['nome']."</option>";
                }
                ?>
            </select>
            <select name="midia" class="novo_lead_select">
                <option value="0">Mídia</option>
                <?
                $midiasQuery = $sql->query("select * from midias order by nome") or die(mysqli_error($sql));
                for($i=0;$i<mysqli_num_rows($midiasQuery);$i++) {
                    $midia = mysqli_fetch_array($midiasQuery);
                    echo "<option value=\"".$midia['indice']."\">".$midia['nome']."</option>";
                }
                ?>
            </select>
            <select name="curso" class="novo_lead_select">
                <option value="0">Curso Desejado</option>
                <?
                $cursosQuery = $sql->query("select * from cursos order by nome") or die(mysqli_error($sql));
                for($i=0;$i<mysqli_num_rows($cursosQuery);$i++) {
                    $curso = mysqli_fetch_array($cursosQuery);
                    echo "<option value=\"".$curso['indice']."\">".$curso['nome']."</option>";
                }
                ?>
            </select>
            <?
                $today = date('Y').'-'.date('m').'-'.date('d');
            ?>
            <input type="date" class="novo_lead_input" name="data" placeholder="Data" value="<?echo $today;?>" required=required>
            <input type="text" class="novo_lead_input" name="estado" placeholder="Estado">
            <input type="text" class="novo_lead_input" name="cidade" placeholder="Cidade">
            <input type="text" class="novo_lead_input" name="bairro" placeholder="Bairro">
            <input type="text" class="novo_lead_input" name="endereco" placeholder="Endereço">
            <input type="text" class="novo_lead_input" name="numero" placeholder="Número">
            <input type="text" class="novo_lead_input" name="rg" placeholder="RG">
            <input type="text" class="novo_lead_input" name="cpf" placeholder="CPF">
            <select name="pontuacao" class="novo_lead_select">
                <option value="0">Pontuação do lead</option>
                <option value="1">1 - Não tem interesse (topo de funil)</option>
                <option value="2">2 - Tem interesse, mas não para agora (meio de funil)</option>
                <option value="3">3 - Tem interesse, mas sem condições financeiras, horário ou curso (fundo de funil)</option>
                <option value="4">4 - Tem interesse, aguardando receber para pagar taxa em x dias (fundo de funil)</option>
                <option value="5">5 - Muito interessado, vindo fechar (fundo de funil)</option>
            </select>
            <?
            if (verificaPermissoes("Exibir vários usuários")) {
                echo "<select name=\"orientador\" class=\"novo_lead_select\" required=required>";
                echo "   <option value=\"\">Orientador</option>";
                $queryIntoFranquias = "";
                if (count($idFranquia)>1 and $_SESSION['usuarioFranquiaId']==0) {
                    $queryIntoFranquias = " where franquia in (";
                    for ($i=0;$i<count($idFranquia);$i++) {
                        if ($i!=0) $queryIntoFranquias .= ",";
                        $queryIntoFranquias .= "'".$idFranquia[$i]."'";
                        $nomeQuery = $sql->query("select nome from franquias where indice = '".$idFranquia[$i]."'") or die(mysqli_error($sql));
                        $nome = mysqli_fetch_array($nomeQuery);
                        echo "   <option value=\"0,".$idFranquia[$i]."\">Geral - ".$nome['nome']."</option>";
                    }
                    $queryIntoFranquias .= ")";
                } else {
                    $queryIntoFranquias = " where franquia in (";
                    $queryIntoFranquias .= "'".$_SESSION['usuarioFranquiaId']."'";
                    $queryIntoFranquias .= ")";
                }
                $usuariosQuery = $sql->query("select usuario, (select nome from usuarios where indice = usuariosfranquias.usuario) as usuarioNome, franquia, (select nome from franquias where indice = usuariosfranquias.franquia) as nomeFranquia from usuariosfranquias".$queryIntoFranquias." and (select cargo from usuarios where usuarios.indice = usuariosfranquias.usuario) in ('3','4','5','6')") or die(mysqli_error($sql));
                for($j=0;$j<mysqli_num_rows($usuariosQuery);$j++) {
                    $usuarios = mysqli_fetch_array($usuariosQuery);
                    echo "   <option value=\"".$usuarios['usuario'].",".$usuarios['franquia']."\">".$usuarios['usuarioNome']." - ".$usuarios['nomeFranquia']."</option>";
                }
                echo "</select>";
            }
            ?>
            <textarea placeholder="Observações:" class="novo_lead_textarea" name="observacoes"></textarea>
            <button type="submit" width="100%" class="novo_lead_button">
                <span>Cadastrar</span>
            </button>
            <a id="novo_lead_cancelar_link" class="novo_lead_cancelar"><p>Cancelar</p></a>
        </form>
    </div>
</div>