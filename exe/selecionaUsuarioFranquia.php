<?
require_once("conecta.php");

	if(isset($_SESSION)) {
		session_destroy();
	}
    session_start();

    $valor = explode(",",$_POST['usuariofranquia']);
    
    $_SESSION['idSelect'] = $valor['0'];
    $_SESSION['usuarioFranquiaId'] = $valor['1'];

	$result['ok'] = true;

echo json_encode($result);
?>