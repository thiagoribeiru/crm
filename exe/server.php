<?
require_once("conecta.php");
updateTabelas();

//CONSTANTES DO SISTEMA -> dentro de conecta.php

session_start();
if(!isset($_SESSION['id']) or $_SESSION['id']=="" or $_SESSION['id']=='undefined') {
	header("Location: login.php");
}

function convertData($destino,$data) {
	$dataReturn = "";
	if($destino=="sql") {
		$dataExplode = explode("/",$data);
		$dataReturn = $dataExplode['2']."-".$dataExplode['1']."-".$dataExplode['0'];
	} else if ($destino=="html") {
		$dataExplode = explode("-",$data);
		$dataReturn = $dataExplode['2']."/".$dataExplode['1']."/".$dataExplode['0'];
	} else {
		$dataReturn = "S/D";
	}
	return $dataReturn;
}

function updateTabelas() {
	global $sql;
	global $sysTeste;
	$executaSysTeste = false;

	//usuarios
	criaTabela("usuarios");
	criaColuna("usuarios","nome","VARCHAR(40)","NOT NULL","indice");
	criaColuna("usuarios","cargo","int","NOT NULL","nome");
	criaColuna("usuarios","login","VARCHAR(40)","NOT NULL","cargo");
	criaColuna("usuarios","senha","VARCHAR(40)","NOT NULL","login");
		$nroUsersQuery = $sql->query("select * from usuarios") or die(mysqli_error($sql));
		$nroUsers = mysqli_num_rows($nroUsersQuery);
		if($nroUsers==0) {
			$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Administrador','1','ADMIN','190f345fd534db88589f9c2a535ccba8')") or die(mysqli_error($sql));
			if($sysTeste) {
				$executaSysTeste = true;
			}
		}

	//franquias
	criaTabela("franquias");
	criaColuna("franquias","nome","VARCHAR(40)","NOT NULL","indice");
		$nroFranquiasQuery = $sql->query("select * from franquias") or die(mysqli_error($sql));
		$nroFranquias = mysqli_num_rows($nroFranquiasQuery);
		if($nroFranquias==0) {
			$sql->query("insert into franquias (nome) values ('SYS_ADM_FRANQUIA')") or die(mysqli_error($sql));
		}
	
	//cargos
	criaTabela("cargos");
	criaColuna("cargos","nome","VARCHAR(40)","NOT NULL","indice");
		$nroCargosQuery = $sql->query("select * from cargos") or die(mysqli_error($sql));
		$nroCargos = mysqli_num_rows($nroCargosQuery);
		if($nroCargos==0) {
			$sql->query("insert into cargos (nome) values ('SYS_ADM')") or die(mysqli_error($sql));
		}

	//permissões
	criaTabela("permissoes");
	criaColuna("permissoes","nome","VARCHAR(40)","NOT NULL","indice");
	criaColuna("permissoes","usuario","int","NOT NULL","nome");
		$permissoes[] = ['Exibir vários usuários',1];
		for ($i=0;$i<count($permissoes);$i++) {
			$nroPermissoesQuery = $sql->query("select * from permissoes where nome = '".$permissoes[$i][0]."' and usuario = '".$permissoes[$i][1]."'") or die(mysqli_error($sql));
			$nroPermissoes = mysqli_num_rows($nroPermissoesQuery);
			if($nroPermissoes==0) {
				$sql->query("insert into permissoes (nome,usuario) values ('".$permissoes[$i][0]."','".$permissoes[$i][1]."')") or die(mysqli_error($sql));
			}
		}
	
	//usuarios e franquias
	criaTabela("usuariosFranquias");
	criaColuna("usuariosFranquias","usuario","int","NOT NULL","indice");
	criaColuna("usuariosFranquias","franquia","int","NOT NULL","usuario");
		$nroUserFranquiaQuery = $sql->query("select * from usuariosFranquias") or die(mysqli_error($sql));
		$nroUserFranquia = mysqli_num_rows($nroUserFranquiaQuery);
		if($nroUserFranquia==0) {
			$sql->query("insert into usuariosFranquias (usuario,franquia) values ('1','1')") or die(mysqli_error($sql));
		}

	// //modulos
	// criaTabela("modulos");
	// criaColuna("modulos","nome","varchar(40)","NOT NULL","indice");
	// criaColuna("modulos","saldo","int","NOT NULL DEFAULT 0","modulos");
	// criaColuna("modulos","prev","int","NOT NULL DEFAULT 0","saldo");

	// //movimentos
	// criaTabela("movimentos");
	// criaColuna("movimentos","modulo","int","NOT NULL","indice");
	// criaColuna("movimentos","data","date","NOT NULL","modulo");
	// criaColuna("movimentos","descricao","varchar(40)","NOT NULL","data");
	// criaColuna("movimentos","tipo","varchar(1)","NOT NULL","descricao");
	// criaColuna("movimentos","quantidade","int","NOT NULL","tipo");

	// //previsão
	// criaTabela("previsao");
	// criaColuna("previsao","aluno","varchar(40)","NOT NULL","indice");
	// criaColuna("previsao","modulo","int","NOT NULL","aluno");
	if ($executaSysTeste) {
		populaDbTeste();
	}
}

function criaTabela($tabela) {
	global $sql;
	$table = $tabela;
	$result = mysqli_query($sql,"SHOW TABLES LIKE '".$table."'");
	$tableExists = $result && $result->num_rows > 0;

	if(!$tableExists) {
		$sql->query("CREATE TABLE IF NOT EXISTS ".$tabela." ( indice INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (indice))") or die(mysqli_error($sql));
	}
}

function criaColuna($tabela,$coluna,$tipo,$attr,$after) {
	global $sql;
	$table = $tabela;
	$result = mysqli_query($sql,"SHOW TABLES LIKE '".$table."'");
	$tableExists = $result && $result->num_rows > 0;

	if($tableExists) {
		$result2 = mysqli_query($sql,"SHOW COLUMNS FROM ".$tabela." where field like '".$coluna."'");
		$columnExists = $result2 && $result2->num_rows > 0;

		if(!$columnExists) {
			$sql->query("ALTER TABLE ".$tabela." ADD ".$coluna." ".$tipo." ".$attr." AFTER ".$after."") or die(mysqli_error($sql));
		}
	} else {
		echo "Tabela de atualização inexistente, parando execução do script. Favor entrar em contato com o administrador do sistema...";
		exit();
	}
}

function verificaPermissoes($permis) {
	$perm = $_SESSION['usuarioPermissoes'];
	$key = array_search($permis,$perm);
	if ($key!="") {
		return true;
	} else {
		return false;
	}
}

function populaDbTeste() {
	global $sql;
	
	//usuários teste
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Douglas Marques','1','douglas','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Rita Carolina','1','rita','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Thiago Ribeiro','1','thiago','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Luana Perpetua','1','luana','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Samantha Sobrenome','1','samantha','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));

	//franquias teste
	$sql->query("insert into franquias (nome) values ('GRAVATAÍ/RS')") or die(mysqli_error($sql));
	$sql->query("insert into franquias (nome) values ('CANOAS/RS')") or die(mysqli_error($sql));

	//usuários franquia teste
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('1','2')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('1','3')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('2','2')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('3','2')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('4','2')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('5','3')") or die(mysqli_error($sql));
	$sql->query("insert into usuariosFranquias (usuario,franquia) values ('6','3')") or die(mysqli_error($sql));
}
?>