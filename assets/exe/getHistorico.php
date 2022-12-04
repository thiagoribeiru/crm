<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$indice = $_POST['indice'];

$result['ok'] = false;
$pesquisaQuery = $sql->query("select indice, (select status.nome from status where indice = historico.status) as status, descricao, (select usuarios.nome from usuarios where usuarios.indice = historico.usuario) as usuario, (DATE_FORMAT(historico.data,'%d/%m/%Y %H:%i:%s')) as data from historico where historico.lead = '".$indice."' order by indice desc") or die(mysqli_error($sql));

$resultPesquisa = Array();
$result['numResults'] = mysqli_num_rows($pesquisaQuery);
if(mysqli_num_rows($pesquisaQuery)>0) {
    for($i=0;$i<mysqli_num_rows($pesquisaQuery);$i++) {
        $linha = mysqli_fetch_array($pesquisaQuery);
        $resultPesquisa[$i] = $linha;
    }
    $result['pesquisa'] = $resultPesquisa;
}

$result['ok'] = true;

echo json_encode($result);
?>