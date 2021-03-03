<?
require_once("exe/conecta.php");
session_start();
if(isset($_SESSION['id']) and $_SESSION['id']!="" and $_SESSION['id']!='undefined') {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="<?echo PAGE_LANG;?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?echo PAGE_NAME;?></title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div id="corpo_login">
        <div id="login_top">
            <div id="login_logo"><img src="img/logo_im.png" alt="" srcset=""></div>
        </div>
        <div id="login_bot">
            <h1>Bem-vindo ao CRM</h1>
            <p>Uma plataforma feita para aumentar seu controle e otimizar suas vendas.</p>
            <div id="login_button">Entrar</div>
            <div id="login_form">
                <div id="login_form_top">Entrar</div>
                <div id="mensagem_erro"></div>
                <form id="login_form_bot">
                    <div><input type="text" name="user" id="login_form_user" placeholder="Login" required></div>
                    <div><input type="password" name="password" id="login_form_password" placeholder="Senha" required></div>
                    <button type="submit" id="login_button_continue">Continue</button>
                    <a id="login_button_cancelar">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>