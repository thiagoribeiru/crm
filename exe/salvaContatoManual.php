<?
require_once("server.php");

    $bairro = $_POST['bairro'];
    $campanha = $_POST['campanha'];
    $cidade = $_POST['cidade'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $data = $_POST['data'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $estado = $_POST['estado'];
    $midia = $_POST['midia'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $orientadorFranquia = explode(",",$_POST['orientador']);
    $orientador = $orientadorFranquia[0];
    $franquia = $orientadorFranquia[1];
    $pontuacao = $_POST['pontuacao'];
    $rg = $_POST['rg'];
    $whatsapp = $_POST['whatsapp'];
    $observacoes = $_POST['observacoes'];

    $sql->query("insert into leads (nome,telefone,email,cod_curso,cod_midia,cod_campanha,cpf,rg,endereco,numero,cidade,estado,bairro,termometro,anotacoes,data_cadastro,cod_orientador,cod_franquia) values ('".$nome."','".$whatsapp."','".$email."','".$curso."','".$midia."','".$campanha."','".$cpf."','".$rg."','".$endereco."','".$numero."','".$cidade."','".$estado."','".$bairro."','".$pontuacao."','".$observacoes."',concat('".$data."',' ',current_time()),'".$orientador."','".$franquia."')") or die(mysqli_error($sql));
    $indice = $sql->insert_id;
    $sql->query("insert into leads_historico (cod_lead,descricao,cod_status,cod_etiqueta,cod_orientador,data_hora) values ('".$indice."','".$observacoes."','1','0','".$_SESSION['id']."',now())") or die(mysqli_error($sql));
    if($indice) {
        $result['id'] = $indice;
        $result['ok'] = true;
    } else {
        $result['ok'] = false;
    }
    echo json_encode($result);
?>