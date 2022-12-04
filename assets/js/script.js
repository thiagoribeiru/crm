import FormLogin from "./FormLogin.js"
import Menu from "./ComponentMenu.js"
import ComponentPaginas from "./ComponentPaginas.js"

$(document).ready(()=>{
    var sessao = Array()
    //verifica session
    const hrefArray = window.location.href.split('/')
    const href = hrefArray[hrefArray.length-1]
    $.ajax({
        url: "/assets/exe/verificaSession.php",
        dataType: 'json',
        success: function(json){
            if(json.ok=='0') {
                if(href!='login.html'&&href!='login') window.location.href = '/login.html'
            } else if(json.ok=='1') {
                if(href=='login.html'||href=='login') window.location.href = '/'
                for (const i in json.session) {
                      sessao[i] = json.session[i]
                }
                if(app) {
                    iniciaApp()
                }
            }
        }
    });

    let loginEntrarBot = document.querySelector("#corpo_login .loginEntrarBot")
    let divLoginWelcome = document.querySelector("#divLoginWelcome")
    let divLoginForm = document.querySelector("#divLoginForm")
    var formLoginLoader = document.querySelector("#formLoginLoader")
    let app = document.querySelector("#app")

    const loginEntrarBotFunc = ()=>{
        var form = new FormLogin
        divLoginForm.appendChild(form)
        $(divLoginWelcome).slideUp()
        $(divLoginForm).slideDown()
    }
    
    const componentPaginas = new ComponentPaginas

    const menuTopo = ()=>{
        let menu = new Menu
        app.appendChild(menu.iniciar(sessao['UsuarioNome'],sessao['EmpresaSessaoNome']))
    }

    const paginaAtiva = ()=>{
        let pathname = window.location.pathname;
        let splitPath = pathname.split('/');
        let path = splitPath[1];
        let containerCentralDiv = document.querySelector("#containerCentralDiv")
        if(path!='') {
            let newPage = false
            switch (path) {
                // case 'novo':
                //     newPage = new PageNovoLead
                //     break;
                // case 'leads':
                //     newPage = new PageLeads
                //     break;
                // case 'profile':
                //     newPage = new PageProfile
                //     break;
                case path:
                	componentPaginas.forEach(opcao => {
			            let linkNome = opcao.link.replaceAll('/','')
			            if(path==linkNome) {
			            	newPage = opcao.obj.iniciar()
			            }
			        });
			        break
            
                default:
                    break;
            }
            containerCentralDiv.appendChild(newPage ? newPage : false)
        }
    }
    
    addEventListener("popstate", function (e) {
	  //window.location.reload()
	  let containerCentralDiv = document.querySelector("#containerCentralDiv")
	  containerCentralDiv.innerHTML = ''
	  paginaAtiva()
	  e.preventDefault();
	});

    const containerCentral = ()=>{
        let containerCentralDiv = document.createElement('div')
        containerCentralDiv.setAttribute('id','containerCentralDiv')
        app.appendChild(containerCentralDiv)
    }

    const iniciaApp = ()=>{
        menuTopo()
        containerCentral()
        paginaAtiva()
    }

    if(loginEntrarBot) {
        $(loginEntrarBot).click(()=>loginEntrarBotFunc())
    }
})






