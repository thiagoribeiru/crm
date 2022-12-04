<?
if (!isset($_SESSION)) session_start();

if(!isset($_SESSION['UsuarioId']) or $_SESSION['UsuarioId']=='') {
    $retorno['ok'] = 0;
} else {
    $retorno['ok'] = 1;
    $retorno['session'] = $_SESSION;
}

echo json_encode($retorno);
?>