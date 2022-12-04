<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$produtosQuery = $sql->query("select codigo, nome from produtos where empresa = ".$_SESSION['EmpresaSessaoId']." order by nome") or die(mysqli_error($sql));

$result = Array();
if(mysqli_num_rows($produtosQuery)>0) {
    for($i=0;$i<mysqli_num_rows($produtosQuery);$i++) {
        $produto = mysqli_fetch_array($produtosQuery);
        $result[$i]['codigo'] = $produto['codigo'];
        $result[$i]['nome'] = $produto['nome'];
    }
}

echo json_encode($result);
?>