<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$midiassQuery = $sql->query("select codigo, nome from midias where empresa = ".$_SESSION['EmpresaSessaoId']." order by nome") or die(mysqli_error($sql));

$result = Array();
if(mysqli_num_rows($midiassQuery)>0) {
    for($i=0;$i<mysqli_num_rows($midiassQuery);$i++) {
        $midias = mysqli_fetch_array($midiassQuery);
        $result[$i]['codigo'] = $midias['codigo'];
        $result[$i]['nome'] = $midias['nome'];
    }
}

echo json_encode($result);
?>