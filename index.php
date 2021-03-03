<?
require_once("exe/server.php");
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="<?echo PAGE_LANG;?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?echo PAGE_NAME;?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div id="corpo">
        <div id="topo1"><?echo $_SESSION['usuarioNome']?> - <?echo $_SESSION['usuarioFranquiaNome']?></div>
        <div id="topo2">
            <div id="menu_ico"><img src="img/fav-menu.png" alt="" srcset=""></div>
            <div id="user">
                <?
                if($_SESSION['nroFranquias']>1) {
                    $franquiaQuery = $sql -> query("select franquia as nroFranquia, (select nome from franquias where franquias.indice = usuariosfranquias.franquia) as nomeFranquia from usuariosfranquias where usuario = '".$_SESSION['id']."'") or die(mysqli_error($sql));
                    echo "<div class=\"user_select\">";
                    echo "  <p class=\"legenda_select\">Franquia:</p>";
                    echo "  <select name=\"franquia\" id=\"select_franquia\">";
                    if ($_SESSION['usuarioFranquiaId']==0) $selectedF0 = " selected=selected";
                    echo "      <option value=\"0\"".$selectedF0.">Geral</option>";
                    for($i=0;$i<mysqli_num_rows($franquiaQuery);$i++) {
                        $franquia = mysqli_fetch_array($franquiaQuery);
                        $idFranquia[] = $franquia['nroFranquia'];
                        if ($_SESSION['usuarioFranquiaId']==$franquia['nroFranquia']) $selectedFi = " selected=selected";
                        else $selectedFi = "";
                        echo "      <option value=\"".$franquia['nroFranquia']."\"".$selectedFi.">".$franquia['nomeFranquia']."</option>";
                    }
                    echo "  </select>";
                    echo "</div>";
                }
                if (verificaPermissoes("Exibir vários usuários")) {
                    $queryIntoFranquias = "";
                    if (count($idFranquia)>1 and $_SESSION['usuarioFranquiaId']==0) {
                        $queryIntoFranquias = " where franquia in (";
                        for ($i=0;$i<count($idFranquia);$i++) {
                            if ($i!=0) $queryIntoFranquias .= ",";
                            $queryIntoFranquias .= "'".$idFranquia[$i]."'";
                        }
                        $queryIntoFranquias .= ")";
                    } else {
                        $queryIntoFranquias = " where franquia in (";
                        $queryIntoFranquias .= "'".$_SESSION['usuarioFranquiaId']."'";
                        $queryIntoFranquias .= ")";
                    }
                    $usuariosQuery = $sql->query("select usuario, (select nome from usuarios where indice = usuariosfranquias.usuario) as usuarioNome, franquia, (select nome from franquias where indice = usuariosfranquias.franquia) as nomeFranquia from usuariosfranquias".$queryIntoFranquias) or die(mysqli_error($sql));
                    echo "<div class=\"user_select\">";
                    echo "  <p class=\"legenda_select\">Usuário:</p>";
                    echo "  <select name=\"usuario\" id=\"select_user\">";
                    $selectedUStr = $_SESSION['idSelect'].",".$_SESSION['usuarioFranquiaId'];
                    if($selectedUStr=="0,0") $selectedU0 = " selected=setected";
                    echo "      <option value=\"0,0\"".$selectedU0.">Geral</option>";
                    for($j=0;$j<mysqli_num_rows($usuariosQuery);$j++) {
                        $usuarios = mysqli_fetch_array($usuariosQuery);
                        if($selectedUStr==$usuarios['usuario'].",".$usuarios['franquia']) $selectedUi = " selected=setected";
                        else $selectedUi = "";
                        echo "      <option value=\"".$usuarios['usuario'].",".$usuarios['franquia']."\"".$selectedUi.">".$usuarios['usuarioNome']." - ".$usuarios['nomeFranquia']."</option>";
                    }
                    echo "  </select>";
                    echo "</div>";
                }
                ?>
            </div>
            <div id="not_leads">
                <img src="img/sino_leads.png" alt="" srcset="">
                <div class="num_leads">4</div>
            </div>
        </div>
        <div id="conteudo">
            <?
            if(!isset($_GET['p'])) header("Location: index.php?p=home");
            else if (file_exists("pages/".$_GET['p'].".php")) {
                require_once("pages/".$_GET['p'].".php");
            } else {
                echo "Página não encontrada!";
            }
            ?>
        </div>
    </div>
    <div id="menu">
        <div id="menu_top">
            <div class="menu_top_esq">
                <div id="inicial_user"><?echo str_split($_SESSION['usuarioNome'],1)[0];?></div>
                <div id="identificacao_user">
                    <div class="nome_user"><?echo $_SESSION['usuarioNome'];?></div>
                    <div class="cargo_user"><?echo $_SESSION['usuarioCargoNome'];?></div>
                </div>
            </div>
            <div class="menu_top_dir"><img src="img/fav-menu.png" alt="" srcset=""></div>
        </div>
        <div id="menu_itens">
            <div class="item_menu" id="menu_home">
                <div class="icon_item_menu"><img src="img/home_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Home</div>
            </div>
            <div class="item_menu" id="menu_agendamentos">
                <div class="icon_item_menu"><img src="img/agendamentos_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Agendamentos</div>
            </div>
            <div class="item_menu" id="menu_pipeline">
                <div class="icon_item_menu"><img src="img/pipeline_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Pipeline</div>
            </div>
            <div class="item_menu" id="menu_contatos">
                <div class="icon_item_menu"><img src="img/contatos_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Contatos</div>
            </div>
            <div class="item_menu" id="menu_novo_contato">
                <div class="icon_item_menu"><img src="img/novo_contato_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Novo Contato</div>
            </div>
            <div class="item_menu" id="menu_relatorios">
                <div class="icon_item_menu"><img src="img/relatorios_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Relatórios</div>
            </div>
            <div class="item_menu" id="menu_configuracoes">
                <div class="icon_item_menu"><img src="img/configuracoes_ico.png" alt="" srcset=""></div>
                <div class="texto_item_menu">Configurações</div>
            </div>
            <div class="item_menu" id="menu_sair">
                <div class="texto_item_menu">Sair</div>
            </div>
        </div>
    </div>
</body>
</html>