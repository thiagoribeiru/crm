<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$campanhasQuery = $sql->query("select codigo, nome from campanhas where empresa = ".$_SESSION['EmpresaSessaoId']." order by nome") or die(mysqli_error($sql));

$result = Array();
if(mysqli_num_rows($campanhasQuery)>0) {
    for($i=0;$i<mysqli_num_rows($campanhasQuery);$i++) {
        $campanha = mysqli_fetch_array($campanhasQuery);
        $result[$i]['codigo'] = $campanha['codigo'];
        $result[$i]['nome'] = $campanha['nome'];
    }
}

echo json_encode($result);
?>