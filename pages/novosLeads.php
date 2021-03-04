<div id="corpo_novos_leads">
    <div id="novos_leads">
        <div id="novos_leads_topo">
            <h1>Novos Leads</h1>
            <svg focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
            </svg>
        </div>
        <div id="div_novos_leads">
            <table id="tabela_novos_leads">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="" id="todos"></th>
                        <th>Nome</th>
                        <th>Mídia</th>
                        <th>Curso</th>
                        <th>Campanha</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $queryIntoFranquiasLeads = "";
                    if (count($idFranquia)>1 and $_SESSION['usuarioFranquiaId']==0) {
                        $queryIntoFranquiasLeads = " where cod_franquia in (";
                        for ($i=0;$i<count($idFranquia);$i++) {
                            if ($i!=0) $queryIntoFranquiasLeads .= ",";
                            $queryIntoFranquiasLeads .= "'".$idFranquia[$i]."'";
                        }
                        $queryIntoFranquiasLeads .= ")";
                    } else {
                        $queryIntoFranquiasLeads = " where cod_franquia in (";
                        $queryIntoFranquiasLeads .= "'".$_SESSION['usuarioFranquiaId']."'";
                        $queryIntoFranquiasLeads .= ")";
                    }
                    $leadsNovosQuery = $sql->query("select indice, nome, (select nome from midias where midias.indice = leads.cod_midia) as midia, (select nome from cursos where cursos.indice = leads.cod_curso) as curso, (select nome from campanhas where campanhas.indice = leads.cod_campanha) as campanha, DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%i') as data from leads".$queryIntoFranquiasLeads." and cod_orientador in ('0')") or die(mysqli_fetch_array($sql));
                    for($i=0;$i<mysqli_num_rows($leadsNovosQuery);$i++) {
                        $leadsNovos = mysqli_fetch_array($leadsNovosQuery);
                    ?>
                    <tr>
                        <td><input type="checkbox" name="<?echo $leadsNovos['indice'];?>"></td>
                        <td><?echo $leadsNovos['nome'];?></td>
                        <td><?if ($leadsNovos['midia']!="") echo $leadsNovos['midia']; else echo "desconhecido";?></td>
                        <td><?if ($leadsNovos['curso']!="") echo $leadsNovos['curso']; else echo "desconhecido";?></td>
                        <td><?if ($leadsNovos['campanha']!="") echo $leadsNovos['campanha']; else echo "desconhecido";?></td>
                        <td><?echo $leadsNovos['data'];?></td>
                        <td>
                            <div>
                                <a href="index.php?p=lead&lead=<?echo $leadsNovos['indice'];?>" id="botao_ver">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                        <path d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z"/>
                                    </svg>
                                    Ver
                                </a>
                            </div>
                            <div>
                                <a href="#" id="botao_editar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                                        <path d="M18 13.45l2-2.023v4.573h-2v-2.55zm-11-5.45h1.743l1.978-2h-3.721v2zm1.361 3.216l11.103-11.216 4.536 4.534-11.102 11.218-5.898 1.248 1.361-5.784zm1.306 3.176l2.23-.472 9.281-9.378-1.707-1.707-9.293 9.388-.511 2.169zm3.333 7.608v-2h-6v2h6zm-8-2h-3v-2h-2v4h5v-2zm13-2v2h-3v2h5v-4h-2zm-18-2h2v-4h-2v4zm2-6v-2h3v-2h-5v4h2z"/>
                                    </svg>
                                    Editar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>