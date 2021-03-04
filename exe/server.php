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
			$sql->query("insert into cargos (nome) values ('Franqueado')") or die(mysqli_error($sql));
			$sql->query("insert into cargos (nome) values ('Gerente Comercial')") or die(mysqli_error($sql));
			$sql->query("insert into cargos (nome) values ('Assistente de Mídias')") or die(mysqli_error($sql));
			$sql->query("insert into cargos (nome) values ('Orientador')") or die(mysqli_error($sql));
			$sql->query("insert into cargos (nome) values ('Telemarketing')") or die(mysqli_error($sql));
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
	
	//campanhas
	criaTabela("campanhas");
	criaColuna("campanhas","nome","VARCHAR(40)","NOT NULL","indice");
		$nroCampanhasQuery = $sql->query("select * from campanhas") or die(mysqli_error($sql));
		$nroCampanhas = mysqli_num_rows($nroCampanhasQuery);
		if($nroCampanhas==0) {
			$sql->query("insert into campanhas (indice,nome) values ('6282','4º Concurso de bolsas (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6283','A beleza vai transformar sua vida (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6284','A escolha certa (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6285','Ação curso de mídias digitais (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6286','Ação de parceria (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8521','Ação Escola Redento (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6287','Agora é minha vez (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6288','Amigo da sorte (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6289','Amizade que gera conhecimento (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6290','Arraial mix (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6291','Até onde seu currículo pode te levar? (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6292','Black friday (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8520','Campanha de Inauguração (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6293','Campanha do agasalho (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7092','Campanha do dia das mães (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8547','Campanha Festa do Vinho (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7098','campanha páscoa (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6294','Campanha regional (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6295','Carna mix (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6296','Concurso de bolsas (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6297','Construindo os meus sonhos (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6298','Curso nas férias (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6299','Dia da beleza (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6300','Dia das crianças (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6301','Dia do trânsito (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7782','Dia dos namorados 2020 (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6302','É dia de gastronomia (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6303','Educação que muda o futuro (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6304','Guia das profissões (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6305','Guiando meus passos (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6306','Halloween IM (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6307','IM contra as drogas (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6308','Indicação premiada (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2577','INDICAÇÃO VALE PIZZA (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7626','Indique e Ganhe (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6309','Jovem profissional (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6310','Ligação premiada (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7704','Mãe que inspira (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6311','Magia do primeiro negócio (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7488','Maratona Profissional Completo IM (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2265','Matrículas Abril (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3447','MATRÍCULAS ABRIL (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4980','Matrículas Abril (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7591','Matrículas Abril (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2627','Matrículas Agosto (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3924','Matrículas agosto (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4984','Matrículas Agosto (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7857','Matrículas Agosto (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3006','Matrículas Dezembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4377','Matrículas Dezembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6041','Matrículas Dezembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3216','MATRÍCULAS FEVEREIRO (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4869','Matrículas Fevereiro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7201','Matrículas Fevereiro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3089','Matrículas Janeiro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4744','Matrículas Janeiro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6042','Matrículas Janeiro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2444','Matrículas Julho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3847','MATRICULAS JULHO (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4983','Matrículas Julho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7856','Matrículas Julho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8096','MATRICULAS JULHO 2020 (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2443','Matrículas Junho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3680','Matrículas Junho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4982','Matrículas Junho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7855','Matrículas Junho (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2367','Matrículas Maio (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3610','MATRÍCULAS MAIO (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4981','Matrículas Maio (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7592','Matrículas Maio (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7354','matrículas março (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2196','Matrículas Março (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3347','Matrículas Março (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4979','Matrículas Março (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('7202','Matrículas Março (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6516','MATRÍCULAS NOVEMBRO (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2884','MATRICULAS NOVEMBRO (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('4376','Matrículas Novembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6040','Matrículas Novembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2781','Matrículas Outubro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3926','Matrículas Outubro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6039','Matrículas Outubro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8677','Matrículas Outubro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6038','Matrículas Setembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8528','MATRÍCULAS SETEMBRO (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2731','Matrículas Setembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('3925','Matrículas Setembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8454','Matriculas Setembro (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6312','Mês da saúde (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6313','Meu amigo é o bicho (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6314','Meu amor merece (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6315','Meu currículo é 10 (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6316','Meu curso é grátis (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6317','Meu pai é o cara (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8569','MIDIAS DIGITAIS (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6318','Mix card (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6319','Natal Imperdível (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6320','Natal solidário (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6321','Novembro azul (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6322','Outubro rosa (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2227','Parceria Sindilojas (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('2266','Parceria Usina do Corpo (Franquia)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6323','Profissional do bairro (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6324','Programa mais educação profissional (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6325','Qual a profissão dos seus sonhos (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6326','Quero bis (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6327','Raspadinha premiada - achou ganhou (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6328','Renovando o conhecimento (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6329','Saldão de cursos (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6330','Seleção IM (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6331','Semana do Brasil (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6332','Semana mix (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6333','Seminário de profissões (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6334','Show de prêmios (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6335','Sua páscoa mais doce (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('8505','treinamento (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6336','Um dia de rainha (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6337','Um sonho de natal (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6338','Visita premiada (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6339','Visualizou ganhou (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6340','Você é um profissional completo ? (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6341','Volta as aulas (Franqueadora)')") or die(mysqli_error($sql));
			$sql->query("insert into campanhas (indice,nome) values ('6342','Whatsapp premiado (Franqueadora)')") or die(mysqli_error($sql));
		}

	//midias
	criaTabela("midias");
	criaColuna("midias","nome","VARCHAR(40)","NOT NULL","indice");
		$nroMidiasQuery = $sql->query("select * from midias") or die(mysqli_error($sql));
		$nroMidias = mysqli_num_rows($nroMidiasQuery);
		if($nroMidias==0) {
			$sql->query("insert into midias (indice,nome) values ('57','Agência de Emprego')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('32','Assistente (Street)')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('74','Assistente Agência')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('37','Atendimento Call Center')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('47','Blog')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('6','Campanha de Indicação')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('55','Carro de som')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('91','Carta')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('19','Cartaz')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('69','Cheque - Antecipação 01º Parcela')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('68','Cheque - Parceria Loja')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('54','Concurso de bolsas')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('9','Corporativo')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('67','Curso de Digitação')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('10','Curso MKT Pessoal')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('41','E-mail - MKT')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('71','Eventos')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('86','Ex-aluno')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('45','Facebook')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('87','Facebook Organico')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('24','Fachada')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('20','Faixa')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('39','Google')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('84','Indicação (Ass Midias)')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('23','Indicação Espontânea')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('82','Instagram')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('17','Jornal')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('38','Lista Telefônica')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('5','Macro Captação')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('83','Macro Captação (Ass Midias)')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('81','Macro Captação (Gerador de visita)')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('85','Macro Digital')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('88','Mala direta')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('4','Mala Direta')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('93','Metrô')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('90','Migracao')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('78','Modelos')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('1','Orientador Externo')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('18','Outdoor')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('8','Palestra MKT Pessoal')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('95','Panfleto')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('3','Panfletos')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('75','Parceria Agência')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('49','Parceria Supermercado')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('13','Parcerias')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('94','Pesquisa')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('59','Porta a Porta')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('65','Pós Venda IM')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('60','Rádio')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('66','raspadinha premiada')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('63','Reativação')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('64','Renegociação')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('7','Renovações')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('80','Resgate Cancelados')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('73','Revista Institucional (Orientação)')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('12','Show Externo')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('26','Site')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('79','Sorteio')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('92','Tabloide')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('25','Telemarketing')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('36','Televendas')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('89','televisão')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('70','Teste Empregabilidade')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('35','Torpedo')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('76','Transferência de Titularidade')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('31','Transferência Entre Franquia')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('77','Troca de Curso')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('15','TV')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('40','Twitter')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('48','Visitas antigas')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('72','Whatsapp')") or die(mysqli_error($sql));
			$sql->query("insert into midias (indice,nome) values ('46','YouTube')") or die(mysqli_error($sql));
		}

	//cursos
	criaTabela("cursos");
	criaColuna("cursos","nome","VARCHAR(40)","NOT NULL","indice");
		$nroCursosQuery = $sql->query("select * from cursos") or die(mysqli_error($sql));
		$nroCursos = mysqli_num_rows($nroCursosQuery);
		if($nroCursos==0) {
			$sql->query("insert into cursos (indice,nome) values ('6','Administração Executiva')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('112','Administração Rural IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('72','Agente de Viagens')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('10','Alongamento de Cílios')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('11','Alongamento de Unhas')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('78','Arquipélago do Saber IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('33','Artesanato em Tecido')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('114','Assessor de Marketing IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('79','Assistente de Marketing IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('65','Atendente de Farmácia e Drogaria')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('107','Atendente de Farmácia e Drogaria IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('80','Atendente de Farmácia IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('134','Autocad IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('55','Autocad®')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('117','Auxiliar Administrativo IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('66','Auxiliar de Laboratório e Análises Clínicas')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('68','Auxiliar de Veterinário')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('67','Auxiliar de Veterinário e Pet Shop')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('17','Barbearia Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('18','Barbearia Profissional Avançada')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('141','Boas Práticas na Manipulação de Alimentos')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('9','Cabeleireiro Profissional Im Academy')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('28','Cake design')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('146','Capacitação Digital')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('2','Capacitação Profissional em Secretariado Jurídico')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('130','Cerimonialista')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('58','CFTV')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('34','Check-In (Básico)')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('25','Chef Internacional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('24','Chef Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('26','Chef Vegano')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('29','Chocolataria')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('49','CIPA')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('132','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('133','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('137','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('142','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('143','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('144','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('145','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('149','Combo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('21','Confeitaria')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('139','Conserto de Celulares')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('31','Corte e Costura')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('27','Cozinha Funcional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('126','Criação De Games IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('81','Criação de Games IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('69','Cuidador de Idosos')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('20','Culinária')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('71','Decoração de Eventos')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('13','Depilação Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('118','Desenvolvedor de Website e Designer Gráfico IMIndi')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('53','Desenvolvedor de Websites E designer Gráfico')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('15','Design de Sobrancelhas')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('82','Design Gráfico IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('57','Designer Gráfico')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('156','Dicção, Desinibição e Oratória')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('110','DJ Profissional IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('119','Editor Gráfico IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('129','Elétrica automotiva')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('42','Eletricista Predial e Residencial')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('131','Eletricista Residencial IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('96','Empreendedorismo IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('125','Excel IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('102','Excel IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('56','Excel® Avançado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('147','Food Trucks')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('54','Fotografia Digital')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('106','Fotografia Digital IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('83','Fotografia Digital IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('70','Garçom e Maître')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('154','Gastronomia II')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('61','Gestão de Mídias Digitais')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('4','Gestão de Pessoas e Liderança')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('3','Gestão em Vendas e Liderança')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('116','Gestão em Vendas IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('84','Gestão Financeira IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('138','GPP e GPE')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('140','Hardware IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('36','Inflight (Intermediário)')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('51','Infomix')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('111','Infomix Interativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('124','Informática Empresarial IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('121','Informática Kids IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('123','Informática Profissional IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('122','Informática Sênior IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('85','Informática Sênior IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('39','Inglês Ead')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('135','Inglês Kids')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('136','Inglês Teens')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('40','Instalação e Manutenção de Ar-Condicionado Split')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('50','Instalador Fotovoltaico')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('73','Inventores de Robôs')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('155','LID e Metrologia')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('113','Logística Empresarial IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('12','Manicure E Pedicure Academia da Beleza')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('14','Maquiagem Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('105','Marketing Digital IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('63','Massagem Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('128','Mecânica automotiva')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('41','Mestre de Obras')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('97','Meu Novo Emprego IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('74','Meu Primeiro Robô')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('19','Microblading')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('16','Micropigmentação')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('148','Micropigmentação Labial')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('98','Mini Gênio da Língua Portuguesa IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('99','Mini Gênio da Matemática IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('32','Modelagem')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('52','Montagem e Manutenção de Computadores, Redes E Not')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('75','Mundos Minecraft')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('48','NR 10')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('46','NR 18')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('47','NR 35')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('109','Operador de Caixa IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('38','Orbit (Avançado)')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('22','Panificação')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('30','Panificação e Confeitaria Vegana')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('76','Piloto de Drone Race')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('7','Porteiro Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('152','Porteiro Profissional')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('151','Preparação e Apresentação de Buffets')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('86','Profissional Digital IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('77','Programação de Games')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('87','Programador Desktop IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('88','Programador Full Web + Mobile IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('89','Programador Java Web IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('90','Programador Mobile IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('91','Programador Php IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('108','Projetista IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('103','Projetista IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('43','Reciclagem NR 10')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('44','Reciclagem NR 18')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('45','Reciclagem NR 35')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('104','Robótica Kids IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('23','Salgadeiro')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('120','Secretariado Executivo IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('92','Secretariado Executivo IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('37','Sky (Pré-Avançado)')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('153','Solda')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('35','Takeoff (Pré-Intermediário)')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('5','Técnicas Administrativas')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('8','Técnicas Administrativas')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('100','Técnicas Sucroalcooleiras IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('115','Turismo e Hotelaria IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('93','Turismo IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('64','Universidade da Vida')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('62','Universidade Dos Nerds')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('150','Venda no Mercado Livre')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('94','Vídeo Maker IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('95','Web Design IMInterativo')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('60','Youtuber Avançado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('59','Youtuber Básico')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('127','Youtuber IMIndividualizado')") or die(mysqli_error($sql));
			$sql->query("insert into cursos (indice,nome) values ('101','Youtuber IMInterativo')") or die(mysqli_error($sql));
		}
	
	//leads
	criaTabela("leads");
	criaColuna("leads","nome","VARCHAR(40)","NOT NULL","indice");
	criaColuna("leads","telefone","bigint","NOT NULL","nome");
	criaColuna("leads","email","VARCHAR(40)","","telefone");
	criaColuna("leads","cod_curso","int","NOT NULL","email");
	criaColuna("leads","cod_midia","int","NOT NULL","cod_curso");
	criaColuna("leads","cod_campanha","int","NOT NULL","cod_midia");
	criaColuna("leads","cpf","bigint","","cod_campanha");
	criaColuna("leads","rg","bigint","","cpf");
	criaColuna("leads","endereco","VARCHAR(40)","","rg");
	criaColuna("leads","numero","int","","endereco");
	criaColuna("leads","cidade","VARCHAR(40)","","numero");
	criaColuna("leads","estado","VARCHAR(40)","","cidade");
	criaColuna("leads","bairro","VARCHAR(40)","","estado");
	criaColuna("leads","termometro","int","NOT NULL","bairro");
	criaColuna("leads","anotacoes","TEXT","NOT NULL","termometro");
	criaColuna("leads","data_cadastro","DATETIME","NOT NULL","anotacoes");
	criaColuna("leads","cod_orientador","int","NOT NULL","data_cadastro");
	criaColuna("leads","cod_franquia","int","NOT NULL","cod_orientador");

	//leads_historico
	criaTabela("leads_historico");
	criaColuna("leads_historico","cod_lead","INT","NOT NULL","indice");
	criaColuna("leads_historico","descricao","TEXT","","cod_lead");
	criaColuna("leads_historico","cod_status","INT","NOT NULL","descricao");
	criaColuna("leads_historico","cod_etiqueta","INT","NOT NULL","cod_status");
	criaColuna("leads_historico","cod_orientador","INT","NOT NULL","cod_etiqueta");
	criaColuna("leads_historico","data_hora","DATETIME","NOT NULL","cod_orientador");

	//status
	criaTabela("status");
	criaColuna("status","nome","VARCHAR(40)","NOT NULL","indice");
		$nroStatusQuery = $sql->query("select * from status") or die(mysqli_error($sql));
		$nroStatus = mysqli_num_rows($nroStatusQuery);
		if($nroStatus==0) {
			$sql->query("insert into status (nome) values ('Novo lead')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Agendado')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Negociação')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Matriculado')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Perda')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Contato Futuro')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Em contato')") or die(mysqli_error($sql));
			$sql->query("insert into status (nome) values ('Pendente')") or die(mysqli_error($sql));
		}

	//etiquetas
	criaTabela("etiquetas");
	criaColuna("etiquetas","nome","VARCHAR(40)","NOT NULL","indice");
	criaColuna("etiquetas","cod_status","int","NOT NULL","nome");
	$nroEtiquetasQuery = $sql->query("select * from etiquetas") or die(mysqli_error($sql));
	$nroEtiquetas = mysqli_num_rows($nroEtiquetasQuery);
	if($nroEtiquetas==0) {
		$sql->query("insert into etiquetas (nome,cod_status) values ('Não atendeu a ligação','1')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Aguardando confirmação do agendamento','2')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Agendamento confirmado','2')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Reagendado','2')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Sem interesse','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Não compareceu','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Não responde','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Sem contato','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Preço','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Horário','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Não há curso','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('De outra cidade','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Duração curso','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Duração aula','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Apenas pesquisa','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Já é aluno(a)','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Curso profissionalizante','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Outro','5')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Aguardando horário disponível','6')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Aguardando o curso','6')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Aguardando promoção','6')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Ligação','7')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Whatsapp','7')") or die(mysqli_error($sql));
		$sql->query("insert into etiquetas (nome,cod_status) values ('Transferência','8')") or die(mysqli_error($sql));
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
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Douglas Marques','5','douglas','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Rita Carolina','5','rita','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Thiago Ribeiro','4','thiago','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Luana Perpetua','5','luana','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));
	$sql->query("insert into usuarios (nome,cargo,login,senha) values ('Samantha Sobrenome','5','samantha','b714337aa8007c433329ef43c7b8252c')") or die(mysqli_error($sql));

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