<?
require_once('./connect.php');
$return['ok'] = 1;

$user = (isset($_POST['user']) and $_POST['user']!='') ? $_POST['user'] : false;
$pass = (isset($_POST['pass']) and $_POST['pass']!='') ? $_POST['pass'] : false;

if($user and $pass) {
    $usuarioQuery = $sql->query("select * from usuarios where email = '".$user."' and senha = AES_ENCRYPT('".$pass."','".$pass."')") or die(mysqli_error($sql));
    if(mysqli_num_rows($usuarioQuery)==1) {
        $return['ok'] = 1;
        if(isset($_SESSION) and isset($_SESSION['UsuarioId']) and $_SESSION['UsuarioId']!='') session_destroy();
        if(!isset($_SESSION)) session_start();
        $usuario = mysqli_fetch_array($usuarioQuery);
        $_SESSION['UsuarioId'] = $usuario['indice'];
        $_SESSION['UsuarioNome'] = $usuario['nome'];
        $_SESSION['UsuarioEmail'] = $usuario['email'];
        $empresasQuery = $sql->query("select empresa as empresaId, (select empresas.nome from empresas where empresas.indice = usuario_empresa.empresa) as empresaNome FROM usuario_empresa where usuario = ".$usuario['indice']) or die(mysqli_error($sql));
        $_SESSION['UsuarioEmpresas'] = Array();
        for($i=0;$i<mysqli_num_rows($empresasQuery);$i++) {
            $empresa = mysqli_fetch_array($empresasQuery);
            $_SESSION['UsuarioEmpresas'][$i]['empresaId'] = $empresa['empresaId'];
            $_SESSION['UsuarioEmpresas'][$i]['empresaNome'] = $empresa['empresaNome'];
            if($i==0) {
                $_SESSION['EmpresaSessaoId'] = $empresa['empresaId'];
                $_SESSION['EmpresaSessaoNome'] = $empresa['empresaNome'];
            }
        }
    } else if(mysqli_num_rows($usuarioQuery)==0) {
        $return['ok'] = 0;
        $return['erro'] = 'Usuário ou senha incorretos.';
    } else {
        $return['ok'] = 0;
        $return['erro'] = 'Consulta retornando '.mysqli_num_rows($usuarioQuery).' resultados.';
    }
} else {
    $return['ok'] = 0;
    $return['erro'] = 'Usuário ou senha indefinidos.';
}

echo json_encode($return);
?>