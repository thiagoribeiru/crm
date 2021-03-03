<?
require_once("conecta.php");

session_start();
session_destroy();
	
$result['ok'] = true;

echo json_encode($result);
?>