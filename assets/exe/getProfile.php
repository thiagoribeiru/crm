<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$indice = $_POST['indice'];

$result['ok'] = false;
$pesquisaQuery = $sql->query("select indice, nome, (select produtos.nome from produtos where leads.interesse = produtos.codigo and ".$_SESSION['EmpresaSessaoId']." = produtos.empresa) as interesse, contato, (select midias.nome from midias where midias.codigo = leads.midia and ".$_SESSION['EmpresaSessaoId']." = leads.empresa) as midia, (DATE_FORMAT(leads.data,'%d/%m/%Y %H:%i:%s')) as data, (select status.nome from status where indice = (select historico.status from historico where historico.lead = leads.indice order by historico.data desc limit 1)) as status from leads where indice = '".$indice."' and empresa = ".$_SESSION['EmpresaSessaoId']." order by indice desc") or die(mysqli_error($sql));

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