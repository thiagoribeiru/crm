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
    $("#menu_novo_contato").click(function(){
        window.location.href = "index.php?p=new";
    });
});