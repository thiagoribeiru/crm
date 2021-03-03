<?
require_once("conecta.php");

	if(isset($_SESSION)) {
		session_destroy();
	}
    session_start();
    
	$_SESSION['usuarioFranquiaId'] = $_POST['franquia'];
	$_SESSION['idSelect'] = 0;

	$result['ok'] = true;

echo json_encode($result);
?>