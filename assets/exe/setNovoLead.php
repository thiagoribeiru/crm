<?
if(!isset($_SESSION)) session_start();
require('connect.php');

$dados = $_POST;

$result = Array();
$result['ok'] = false;

$queryTag = '';
$queryVal = '';

if(isset($dados['nome']) and $dados['nome']) {$queryTag .= 'nome,'; $queryVal .= '\''.$dados['nome'].'\',';}
if(isset($dados['contato']) and $dados['contato']) {$queryTag .= 'contato,'; $queryVal .= '\''.preg_replace("/[^0-9]/", "", $dados['contato']).'\',';}
if(isset($dados['email']) and $dados['email']) {$queryTag .= 'email,'; $queryVal .= '\''.$dados['email'].'\',';}
if(isset($dados['campanha']) and $dados['campanha']) {$queryTag .= 'campanha,'; $queryVal .= '\''.$dados['campanha'].'\',';}
if(isset($dados['midia']) and $dados['midia']) {$queryTag .= 'midia,'; $queryVal .= '\''.$dados['midia'].'\',';}
if(isset($dados['interesse']) and $dados['interesse']) {$queryTag .= 'interesse,'; $queryVal .= '\''.$dados['interesse'].'\',';}
if(isset($dados['cep']) and $dados['cep']) {$queryTag .= 'cep,'; $queryVal .= '\''.preg_replace("/[^0-9]/", "", $dados['cep']).'\',';}
if(isset($dados['estado']) and $dados['estado']) {$queryTag .= 'estado,'; $queryVal .= '\''.$dados['estado'].'\',';}
if(isset($dados['cidade']) and $dados['cidade']) {$queryTag .= 'cidade,'; $queryVal .= '\''.$dados['cidade'].'\',';}
if(isset($dados['endereco']) and $dados['endereco']) {$queryTag .= 'endereco,'; $queryVal .= '\''.$dados['endereco'].'\',';}
if(isset($dados['numResidencia']) and $dados['numResidencia']) {$queryTag .= 'numResidencia,'; $queryVal .= '\''.$dados['numResidencia'].'\',';}
if(isset($dados['complemento']) and $dados['complemento']) {$queryTag .= 'complemento,'; $queryVal .= '\''.$dados['complemento'].'\',';}
if(isset($dados['rg']) and $dados['rg']) {$queryTag .= 'rg,'; $queryVal .= '\''.preg_replace("/[^0-9]/", "", $dados['rg']).'\',';}
if(isset($dados['cpf']) and $dados['cpf']) {$queryTag .= 'cpf,'; $queryVal .= '\''.preg_replace("/[^0-9]/", "", $dados['cpf']).'\',';}
if(isset($dados['observacoes']) and $dados['observacoes']) {$queryTag .= 'observacoes,'; $queryVal .= '\''.$dados['observacoes'].'\',';} else {$queryTag .= 'observacoes,'; $queryVal .= '\'\',';}

$sql->query("insert into leads (".$queryTag."empresa,data,usuario) values (".$queryVal."'".$_SESSION['EmpresaSessaoId']."',now(),'".$_SESSION['UsuarioId']."')") or die (mysqli_error($sql));
$retId = mysqli_insert_id($sql);
$sql->query("insert into historico (lead,status,descricao,data,usuario) values ('".$retId."',1,'Lead adicionado por ".$_SESSION['UsuarioNome']." manualmente.',now(),'".$_SESSION['UsuarioId']."')") or die(mysqli_error($sql));
$result['ok'] = true;
$result['id'] = $retId;

echo json_encode($result);
?>