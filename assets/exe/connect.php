<?
$arqOk = true;
$importConf = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/assets/exe/config.php';

if(file_exists($importConf)) {
	require_once($importConf);
	$arqOk = $arqOk ? isset($localBd) : false;
	$arqOk = $arqOk ? isset($usuarioBd) : false;
	$arqOk = $arqOk ? isset($senhaBd) : false;
	$arqOk = $arqOk ? isset($bancoDeDados) : false;
	if(!$arqOk) {
		echo "Arquivo de configuração com argumentos insuficientes. Por favor contacte o administrador do sistema.";
		exit;
	}
} else {
	echo "Arquivos de configuração ausentes. Por favor contacte o administrador do sistema.";
	exit;
}

$sql = new mysqli($localBd, $usuarioBd, $senhaBd, $bancoDeDados);
mysqli_set_charset($sql,"utf8");

//criação de tabelas
updateTabelas();
function updateTabelas() {
	global $sql;

	//empresas
	criaTabela("empresas");
	criaColuna("empresas","nome","VARCHAR(100)","NOT NULL","indice");
	criaColuna("empresas","email","VARCHAR(100)","NOT NULL","nome");
	criaColuna("empresas","data","DATETIME","NOT NULL","email");

	//usuario_empresa
	criaTabela("usuario_empresa");
	criaColuna("usuario_empresa","usuario","INT","NOT NULL","indice");
	criaColuna("usuario_empresa","empresa","INT","NOT NULL","usuario");
	criaColuna("usuario_empresa","data","DATETIME","NOT NULL","empresa");

	//usuarios
	criaTabela("usuarios");
	criaColuna("usuarios","nome","VARCHAR(100)","NOT NULL","indice");
	criaColuna("usuarios","email","VARCHAR(100)","NOT NULL","nome");
	criaColuna("usuarios","senha","VARBINARY(255)","NOT NULL","email");
	criaColuna("usuarios","empresa","INT","NOT NULL","senha");
	criaColuna("usuarios","data","DATETIME","NOT NULL","empresa");

	//campanhas
	criaTabela("campanhas");
	criaColuna("campanhas","codigo","INT","NOT NULL","indice");
	criaColuna("campanhas","nome","VARCHAR(100)","NOT NULL","codigo");
	criaColuna("campanhas","empresa","INT","NOT NULL","nome");
	criaColuna("campanhas","data","DATETIME","NOT NULL","empresa");

	//midias
	criaTabela("midias");
	criaColuna("midias","codigo","INT","NOT NULL","indice");
	criaColuna("midias","nome","VARCHAR(100)","NOT NULL","codigo");
	criaColuna("midias","empresa","INT","NOT NULL","nome");
	criaColuna("midias","data","DATETIME","NOT NULL","empresa");

	//produtos
	criaTabela("produtos");
	criaColuna("produtos","codigo","INT","NOT NULL","indice");
	criaColuna("produtos","nome","VARCHAR(100)","NOT NULL","codigo");
	criaColuna("produtos","empresa","INT","NOT NULL","nome");
	criaColuna("produtos","data","DATETIME","NOT NULL","empresa");

	//cidades
	criaTabela("cidades");
	criaColuna("cidades","cidade","VARCHAR(100)","NOT NULL","indice");
	criaColuna("cidades","estado","VARCHAR(10)","NOT NULL","cidade");

	//estados
	criaTabela("estados");
	criaColuna("estados","estado","VARCHAR(100)","NOT NULL","indice");
	criaColuna("estados","sigla","VARCHAR(10)","NOT NULL","estado");

	//leads
	criaTabela("leads");
	criaColuna("leads","nome","VARCHAR(100)","NOT NULL","indice");
	criaColuna("leads","contato","VARCHAR(50)","NOT NULL","nome");
	criaColuna("leads","email","VARCHAR(100)","NOT NULL DEFAULT ''","contato");
	criaColuna("leads","campanha","INT","NOT NULL DEFAULT 0","email");
	criaColuna("leads","midia","INT","NOT NULL DEFAULT 0","campanha");
	criaColuna("leads","interesse","INT","NOT NULL DEFAULT 0","midia");
	criaColuna("leads","cep","VARCHAR(50)","NOT NULL DEFAULT ''","interesse");
	criaColuna("leads","estado","INT","NOT NULL DEFAULT 0","cep");
	criaColuna("leads","cidade","INT","NOT NULL DEFAULT 0","estado");
	criaColuna("leads","endereco","VARCHAR(200)","NOT NULL DEFAULT ''","cidade");
	criaColuna("leads","numResidencia","VARCHAR(50)","NOT NULL DEFAULT ''","endereco");
	criaColuna("leads","complemento","VARCHAR(50)","NOT NULL DEFAULT ''","numResidencia");
	criaColuna("leads","rg","VARCHAR(50)","NOT NULL DEFAULT ''","complemento");
	criaColuna("leads","cpf","VARCHAR(50)","NOT NULL DEFAULT ''","rg");
	criaColuna("leads","observacoes","TEXT","NOT NULL","cpf");
	criaColuna("leads","empresa","INT","NOT NULL","observacoes");
	criaColuna("leads","data","DATETIME","NOT NULL","empresa");
	criaColuna("leads","usuario","INT","NOT NULL","data");
	
	//status
	criaTabela("status");
	criaColuna("status","nome","VARCHAR(100)","NOT NULL","indice");
	criaColuna("status","empresa","INT","NOT NULL","nome");
	criaColuna("status","data","DATETIME","NOT NULL","empresa");
	criaColuna("status","usuario","INT","NOT NULL","data");
	
	//histórico
	criaTabela("historico");
	criaColuna("historico","lead","INT","NOT NULL DEFAULT 0","indice");
	criaColuna("historico","status","INT","NOT NULL DEFAULT 0","lead");
	criaColuna("historico","descricao","VARCHAR(100)","NOT NULL","status");
	criaColuna("historico","data","DATETIME","NOT NULL","descricao");
	criaColuna("historico","usuario","INT","NOT NULL","data");
	

	//registros iniciais
	$senhaPadrao = 'Trdw9191';
	$empresasQuery = $sql->query("select * from empresas") or die (mysqli_error($sql));
	if(mysqli_num_rows($empresasQuery)==0) {
		//SYSTEM
		$sql->query("insert into empresas (nome,email,data) values ('SYSTEM','postmaster@commitweb.com.br',now())") or die(mysqli_error($sql));
		//COMMITWEB
		$sql->query("insert into empresas (nome,email,data) values ('CommitWeb','thiago.cja@gmail.com',now())") or die(mysqli_error($sql));
	}
	$usuariosQuery = $sql->query("select * from usuarios") or die (mysqli_error($sql));
	if(mysqli_num_rows($usuariosQuery)==0) {
		//SYSTEM
		$sql->query("insert into usuarios (nome,email,senha,empresa,data) values ('SYSTEM','postmaster@commitweb.com.br',AES_ENCRYPT('".$senhaPadrao."','".$senhaPadrao."'),1,now())") or die(mysqli_error($sql));
		$sql->query("insert into usuario_empresa (usuario,empresa,data) values(1,1,now())") or die(mysqli_error($sql));
		//COMMITWEB
		$sql->query("insert into usuarios (nome,email,senha,empresa,data) values ('Thiago R. Ribeiro','thiago.cja@gmail.com',AES_ENCRYPT('".$senhaPadrao."','".$senhaPadrao."'),2,now())") or die(mysqli_error($sql));
		$sql->query("insert into usuario_empresa (usuario,empresa,data) values(2,2,now())") or die(mysqli_error($sql));
	}
	$statusQuery = $sql->query("select * from status") or die (mysqli_error($sql));
	if(mysqli_num_rows($statusQuery)==0) {
		$sql->query("insert into status (nome,empresa,data,usuario) values ('NOVO LEAD',2,now(),1)") or die(mysqli_error($sql));
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
?>