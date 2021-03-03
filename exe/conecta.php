<?
$sysTeste = true;
$localBd = "localhost";
$usuarioBd = "root";
$senhaBd = "";
$bancoDeDados = "crm_teste";

$sql = new mysqli($localBd, $usuarioBd, $senhaBd, $bancoDeDados);
mysqli_set_charset($sql,"utf8");

//CONSTANTES DO SISTEMA
const PAGE_NAME = "CRM Instituto Mix GTI/CNS";
const PAGE_LANG = "pt-br";
?>