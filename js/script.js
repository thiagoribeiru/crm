$(document).ready(function(){

    $("#login_button").click(function(){
        $("#login_button").toggle("fast");
        $("#login_form").toggle("fast");
    });

    $("#login_button_cancelar").click(function(){
        $("#login_button").toggle("fast");
        $("#login_form").toggle("fast");
    });

    $("#login_form_bot").submit(function(){
		form = $(this).serializeArray();
        dados = new Array();
        required = true;
		$.each(form, function(i, field){
            if (field.value=="") {
                required = false;
            }
			dados[field.name] = field.value;
        });
        if (required==true) {
            $.ajax({
            	url: "exe/fazLogin.php",
            	type: "POST",
            	dataType: "json",
            	data: {
            		'login': dados['user'],
            		'senha': dados['password']
            	},
            	success: function( json ) {
            		if(json.ok==true) {
            			window.location.href = "index.php";
            		} else {
            			$("#mensagem_erro").html("Senha ou usuário incorreto! Verifique e tente novamente.");
            			$("#mensagem_erro").slideDown(200);
            			setTimeout(() => {
            			  $("#mensagem_erro").slideUp(200);
                        }, 3000);
            		}
            	},
            	error: function() {
            		$("#mensagem_erro").html("Algo deu errado!");
            		$("#mensagem_erro").slideDown(200);
            		setTimeout(() => {
            		  $("#mensagem_erro").slideUp(200);
                    }, 3000);
            	}
            });
        }

		return false;
    });

    $("#menu_ico").click(function(){
        $("#menu").toggle();
    });
    $("#menu .menu_top_dir img").click(function(){
        $("#menu").toggle();
    });

    $("#menu_sair").click(function(){
        $.ajax({
            url: "exe/logout.php",
            type: "POST",
            dataType: "json",
            data: {},
            success: function( json ) {
                if(json.ok==true) {
                    window.location.href = "index.php";
                }
            }
        });
    });

    $("#select_franquia").change(function(){
        valor = $("#select_franquia").val();
        $.ajax({
            url: "exe/selecionaFranquia.php",
            type: "POST",
            dataType: "json",
            data: {
                'franquia':valor
            },
            success: function( json ) {
                if(json.ok==true) {
                    window.location.reload();
                }
            }
        });
    });

    $("#select_user").change(function(){
        valor = $("#select_user").val();
        $.ajax({
            url: "exe/selecionaUsuarioFranquia.php",
            type: "POST",
            dataType: "json",
            data: {
                'usuariofranquia':valor
            },
            success: function( json ) {
                if(json.ok==true) {
                    window.location.reload();
                }
            }
        });
    });

    $("#menu_home").click(function(){
        window.location.href = "index.php?p=home";
    });
    $("#novos_leads #novos_leads_topo svg").click(function(){
        window.location.href = "index.php?p=home";
    });
    $("#menu_novo_contato").click(function(){
        window.location.href = "index.php?p=new";
    });
    $("#mais_novo_contato").click(function(){
        window.location.href = "index.php?p=new";
    });
    $("#novo_lead_cancelar_link").click(function(){
        window.location.href = "index.php?p=new";
    });
    $("#botao_new_manual").click(function(){
        window.location.href = "index.php?p=new_manual";
    });
    $("#not_leads").click(function(){
        window.location.href = "index.php?p=novosLeads&pag=1";
    });

    $("#form_lead_manual").submit(function(){
        form = $("#form_lead_manual").serializeArray();
        dados = new Array();
        required = true;
		$.each(form, function(i, field){
            // if (field.value=="") {
            //     required = false;
            // }
            if (dados[field.name]=="nome" && field.value=="") required = false;
            if (dados[field.name]=="whatsapp" && field.value=="") required = false;
            if (dados[field.name]=="data" && field.value=="") required = false;
			dados[field.name] = field.value;
        });
        if (required==true) {
            dados['whatsapp'] = dados['whatsapp'].replaceAll("(","").replaceAll(")","").replaceAll("_","").replaceAll("-","").replaceAll(" ","");
            $.ajax({
            	url: "exe/salvaContatoManual.php",
            	type: "POST",
            	dataType: "json",
            	data: {
                    'nome':dados['nome'],
                    'whatsapp':dados['whatsapp'],
                    'email':dados['email'],
                    'campanha':dados['campanha'],
                    'midia':dados['midia'],
                    'curso':dados['curso'],
                    'data':dados['data'],
                    'estado':dados['estado'],
                    'cidade':dados['cidade'],
                    'bairro':dados['bairro'],
                    'endereco':dados['endereco'],
                    'numero':dados['numero'],
                    'rg':dados['rg'],
                    'cpf':dados['cpf'],
                    'pontuacao':dados['pontuacao'],
                    'orientador':dados['orientador'],
                    'observacoes':dados['observacoes']
                },
            	success: function( json ) {
            		if(json.ok==true) {
                        window.location.href = "index.php?p=new";
                        indice = json.id;
            		} else {
            			console.log("Algo deu errado!");
            		}
            	},
            	error: function() {
                    console.log("Erro na função JS!");
            	}
            });
        }
		return false;
    });

    $("#form_lead_manual input[type='tel']").focus(function(){
        valor = $(this).val().replaceAll("(","").replaceAll(")","").replaceAll("_","").replaceAll("-","").replaceAll(" ","");
        if(valor=="") {
            $(this).val("(__) _ ____-____");
        }
    });
    $("#form_lead_manual input[type='tel']").blur(function(){
        valor = $(this).val().replaceAll("(","").replaceAll(")","").replaceAll("_","").replaceAll("-","").replaceAll(" ","");
        if(valor=="") {
            $(this).val("");
        } else if(valor.length==10) {
            novo = "";
            for(i=0;i<14;i++) {
                if(i==0) novo += "(";
                if(i==1) {novo += valor[0];}
                if(i==2) {novo += valor[1];}
                if(i==3) novo += ")";
                if(i==4) novo += " ";
                if(i==5) {novo += valor[2];}
                if(i==6) {novo += valor[3];}
                if(i==7) {novo += valor[4];}
                if(i==8) {novo += valor[5];}
                if(i==9) novo += "-";
                if(i==10) {novo += valor[6];}
                if(i==11) {novo += valor[7];}
                if(i==12) {novo += valor[8];}
                if(i==13) {novo += valor[9];}
            }
            $(this).val(novo);
        }
    });
    $("#form_lead_manual input[type='tel']").keydown(function(e){
        if(!isNaN(e.key)) { 
            valor = $(this).val().replaceAll("(","").replaceAll(")","").replaceAll("_","").replaceAll("-","").replaceAll(" ","");
            valor = valor+e.key;
            contValor = 0;
            novo = "";
            for(i=0;i<16;i++) {
                if (valor[contValor]!=undefined) {
                    if(i==0) novo += "(";
                    if(i==1) {novo += valor[0]; contValor++;}
                    if(i==2) {novo += valor[1]; contValor++;}
                    if(i==3) novo += ")";
                    if(i==4) novo += " ";
                    if(i==5) {novo += valor[2]; contValor++;}
                    if(i==6) novo += " ";
                    if(i==7) {novo += valor[3]; contValor++;}
                    if(i==8) {novo += valor[4]; contValor++;}
                    if(i==9) {novo += valor[5]; contValor++;}
                    if(i==10) {novo += valor[6]; contValor++;}
                    if(i==11) novo += "-";
                    if(i==12) {novo += valor[7]; contValor++;}
                    if(i==13) {novo += valor[8]; contValor++;}
                    if(i==14) {novo += valor[9]; contValor++;}
                    if(i==15) {novo += valor[10]; contValor++;}
                } else {
                    if(i==0) novo += "(";
                    if(i==1) novo += "_";
                    if(i==2) novo += "_";
                    if(i==3) novo += ")";
                    if(i==4) novo += " ";
                    if(i==5) novo += "_";
                    if(i==6) novo += " ";
                    if(i==7) novo += "_";
                    if(i==8) novo += "_";
                    if(i==9) novo += "_";
                    if(i==10) novo += "_";
                    if(i==11) novo += "-";
                    if(i==12) novo += "_";
                    if(i==13) novo += "_";
                    if(i==14) novo += "_";
                    if(i==15) novo += "_";
                }
            }
            $(this).val(novo);
            e.preventDefault();
        } else if((e.key).length==1) {
            e.preventDefault();
        }
    });
});