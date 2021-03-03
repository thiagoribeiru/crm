<?
require_once("conecta.php");
$usuario = strtoupper($_POST['login']);
$senha = md5(sha1($_POST['senha']));
$userQuery = $sql->query("select indice, nome, (select nome from cargos where indice = usuarios.cargo) as cargoNome, login from usuarios where login = '".$usuario."' and senha = '".$senha."' limit 1") or die(mysqli_error($sql));
if(mysqli_num_rows($userQuery)>0) {
	$user = mysqli_fetch_array($userQuery);
	if(isset($_SESSION)) {
		session_destroy();
	}
	session_start();
    $_SESSION['id'] = $user['indice'];
    $_SESSION['idSelect'] = $user['indice'];
    $_SESSION['usuarioNome'] = $user['nome'];
    $_SESSION['usuarioCargoNome'] = $user['cargoNome'];
    $_SESSION['usuarioLogin'] = $user['login'];
    $_SESSION['page'] = "home";

    //permissoes
    $permissoesUsuarioQuery = $sql->query("select nome from permissoes where usuario = '".$_SESSION['id']."'") or die(mysqli_error($sql));
    $_SESSION['usuarioPermissoes'] = [];
    if (mysqli_num_rows($permissoesUsuarioQuery)>0) {
        $quantPermissoes = mysqli_num_rows($permissoesUsuarioQuery);
        for($i=1;$i<=$quantPermissoes;$i++) {
            $permissoesUsuario = mysqli_fetch_array($permissoesUsuarioQuery);
            $_SESSION['usuarioPermissoes'][$i] = $permissoesUsuario['nome'];
        }
    }

    //franquias
    $nroFranquiasQuery = $sql->query("select franquia, (select nome from franquias where franquias.indice = usuariosfranquias.franquia) as nomeFranquia from usuariosfranquias where usuario = '".$_SESSION['id']."'") or die(mysqli_error($sql));
    $_SESSION['nroFranquias'] = mysqli_num_rows($nroFranquiasQuery);
    if ($_SESSION['nroFranquias']>1) {
        $_SESSION['usuarioFranquiaNome'] = "Todas";
        $_SESSION['usuarioFranquiaId'] = 0;
    } else {
        $nroFranquias = mysqli_fetch_array($nroFranquiasQuery);
        $_SESSION['usuarioFranquiaNome'] = $nroFranquias['nomeFranquia'];
        $_SESSION['usuarioFranquiaId'] = $nroFranquias['franquia'];
    }


	$result['ok'] = true;
} else {
	$result['ok'] = false;
}
echo json_encode($result);
?>