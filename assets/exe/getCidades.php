<?
require('connect.php');

$sigla = $_POST['siglaEstado'];
$cidadesQuery = $sql->query("select indice, cidade from cidades where estado = '".$sigla."' order by cidade") or die(mysqli_error($sql));

$result = Array();
if(mysqli_num_rows($cidadesQuery)>0) {
    for($i=0;$i<mysqli_num_rows($cidadesQuery);$i++) {
        $cidade = mysqli_fetch_array($cidadesQuery);
        $result[$i]['indice'] = $cidade['indice'];
        $result[$i]['cidade'] = $cidade['cidade'];
    }
}

echo json_encode($result);
?>