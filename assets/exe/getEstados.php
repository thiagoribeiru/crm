<?
require('connect.php');

$estadosQuery = $sql->query("select indice, estado, sigla from estados order by estado") or die(mysqli_error($sql));

$result = Array();
if(mysqli_num_rows($estadosQuery)>0) {
    for($i=0;$i<mysqli_num_rows($estadosQuery);$i++) {
        $estado = mysqli_fetch_array($estadosQuery);
        $result[$i]['indice'] = $estado['indice'];
        $result[$i]['estado'] = $estado['estado'];
        $result[$i]['sigla'] = $estado['sigla'];
    }
}

echo json_encode($result);
?>