import AbrePagina from './ComponentLinks.js'
import ComponentPagina from './ComponentPaginas.js'

export default class Menu {
    constructor() {
        
    }
    iniciar(nome,empresaNome) {
    	this.menuHeader = document.createElement('div')
        this.menuHeader.setAttribute('id','menuHeader')

	        this.menuBot = new DivMenuBot        
	        this.menuHeader.appendChild(this.menuBot)
	
	        this.divMenuLogo = document.createElement('div')
	        this.divMenuLogo.setAttribute('id','divMenuLogo')
	
		        this.imgMenuLogo = document.createElement('img')
		        this.imgMenuLogo.setAttribute('src','/assets/img/imgMenuLogo.png')
		        this.imgMenuLogo.setAttribute('class','imgMenuLogo')
	
	        this.divMenuLogo.appendChild(this.imgMenuLogo)
	        this.menuHeader.appendChild(this.divMenuLogo)

	        this.menuOpen = document.createElement('div')
	        this.menuOpen.setAttribute('id','menuOpen')
	        
	        	this.menuOpenInt = document.createElement('div')
	        	this.menuOpenInt.setAttribute('class','menuOpenInt')
	        
		        	this.divOpenLeft = document.createElement('div')
		        	this.divOpenLeft.setAttribute('class','divOpenLeft')
		
				        this.divOpenHeader = document.createElement('div')
				        this.divOpenHeader.setAttribute('class','divOpenHeader')
				
				        	this.menuBot2 = new DivMenuBot
				
				        this.divOpenHeader.appendChild(this.menuBot2)
			
				        this.divOpenUser = document.createElement('div')
				        this.divOpenUser.setAttribute('class','divOpenUser')
				
					        this.divOpenUserEsquerda = document.createElement('div')
					        this.divOpenUserEsquerda.setAttribute('class','divOpenUserEsquerda')
					
					        this.divOpenUserLetra = document.createElement('div')
					        this.divOpenUserLetra.setAttribute('class','divOpenUserLetra')
					
					        	this.divOpenUserLetraP = document.createElement('p')
					
					        this.divOpenUserLetra.appendChild(this.divOpenUserLetraP)
				
				        this.divOpenUserEsquerda.appendChild(this.divOpenUserLetra)
				        this.divOpenUser.appendChild(this.divOpenUserEsquerda)
				
				        this.divOpenUserCentro = document.createElement('div')
				        this.divOpenUserCentro.setAttribute('class','divOpenUserCentro')
				
					        this.divOpenUserNome = document.createElement('div')
					        this.divOpenUserNome.setAttribute('class','divOpenUserNome')
					
					        this.divOpenUserEmpresa = document.createElement('div')
					        this.divOpenUserEmpresa.setAttribute('class','divOpenUserEmpresa')
				
				        this.divOpenUserCentro.appendChild(this.divOpenUserNome)
				        this.divOpenUserCentro.appendChild(this.divOpenUserEmpresa)
				        this.divOpenUser.appendChild(this.divOpenUserCentro)
				
				        this.divOpenUserDireita = document.createElement('div')
				        this.divOpenUserDireita.setAttribute('class','divOpenUserDireita')
				
					        this.divOpenUserEditSeta = document.createElement('div')
					        this.divOpenUserEditSeta.setAttribute('class','divOpenUserEditSeta')
					
					        this.divOpenUserEdit = document.createElement('div')
					        this.divOpenUserEdit.setAttribute('class','divOpenUserEdit')
					
						        this.divOpenUserEditImg = document.createElement('img')
						        this.divOpenUserEditImg.setAttribute('src','/assets/img/imgUserEdit.png')
				
				        this.divOpenUserEdit.appendChild(this.divOpenUserEditImg)
				        this.divOpenUserDireita.appendChild(this.divOpenUserEditSeta)
				        this.divOpenUserDireita.appendChild(this.divOpenUserEdit)
				        this.divOpenUser.appendChild(this.divOpenUserDireita)
				        
					this.divOpenLeft.appendChild(this.divOpenHeader)
					this.divOpenLeft.appendChild(this.divOpenUser)
		        	
		        	this.divOpenRight = document.createElement('div')
		        	this.divOpenRight.setAttribute('class','divOpenRight')
	
		        this.menuOpenInt.appendChild(this.divOpenLeft)
		        this.menuOpenInt.appendChild(this.divOpenRight)
		        
		    this.menuOpen.appendChild(this.menuOpenInt)
	
	        	this.menuLista = new MenuOpcoes
	
	        this.menuHeader.appendChild(this.menuOpen)

        this.retorno = this.menuHeader
        
        
        $(this.divOpenRight).click(()=>{
        	let abreFechaMenu = new AbreFechaMenu
            abreFechaMenu.abreFechaMenu()
        })
        
        //inicio do menu
        
        
        
    	
        this.divOpenUserLetraP.textContent = nome.charAt(0).toUpperCase()
        this.divOpenUserNome.textContent =  nome
        this.divOpenUserEmpresa.textContent = empresaNome
        this.divOpenLeft.appendChild(this.menuLista.get())
        return this.retorno
    }
}

class DivMenuBot {
    constructor() {
        var divMenuBot = document.createElement('div')
        divMenuBot.setAttribute('class','divMenuBot')

	        var imgMenuBot = document.createElement('img')
	        imgMenuBot.setAttribute('src','/assets/img/imgMenuBot.png')
	        imgMenuBot.setAttribute('class','imgMenuBot')

        divMenuBot.appendChild(imgMenuBot)

        $(divMenuBot).click(()=>{
            // $(menuOpen).animate({width:'toggle'},250);
            var abreFechaMenu = new AbreFechaMenu
            abreFechaMenu.abreFechaMenu()
        })

        return divMenuBot
    }
}

class MenuOpcoes {
    constructor() {
        this.divOpenMenu = document.createElement('div')
        this.divOpenMenu.setAttribute('class','divOpenMenu')

	        this.divOpenMenuCont = document.createElement('div')
	        this.divOpenMenuCont.setAttribute('class','divOpenMenuCont')

		        this.botaoHome = new OpcaoMenu
		        this.botaoHome.setNome('Home')
		        this.botaoHome.setImg('/assets/img/imgMenuOpcaoHome.png')
		        this.botaoHome.setLink('/')
		        
	        this.divOpenMenuCont.appendChild(this.botaoHome.get())

		        this.divOpcoesMenu = document.createElement('div')
		        this.divOpcoesMenu.setAttribute('class','divOpcoesMenu')
		        
	        this.divOpenMenuCont.appendChild(this.divOpcoesMenu)

		        this.botaoSair = new OpcaoMenu
		        this.botaoSair.setNome('Sair')
		        this.botaoSair.setImg('/assets/img/imgMenuOpcaoSair.png')
		        this.botaoSair.setId('botaoSair')
		        
		        this.botaoSairBot = this.botaoSair.get()
		        $(this.botaoSairBot).click(()=>{
		            $.ajax({
		                url: "/assets/exe/logout.php",
		                success: function(){
		                    window.location.reload()
		                }
		            });
		        })
	        this.divOpenMenuCont.appendChild(this.botaoSairBot)

        this.divOpenMenu.appendChild(this.divOpenMenuCont)

        // this.opcoes = [
        // 	{nome:'Leads',img:'/assets/img/imgMenuOpcaoLeads.png',link:'/leads/'},
        //     {nome:'Novo Lead',img:'/assets/img/imgMenuOpcaoNovoLead.png',link:'/novo/'}
        // ]

        this.retorno = this.divOpenMenu
    }
    get() {
        // this.opcoes.forEach(opcao => {
        //     let botao = new OpcaoMenu
        //     botao.setNome(opcao.nome)
        //     botao.setImg(opcao.img)
        //     botao.setLink(opcao.link)
        //     this.divOpcoesMenu.appendChild(botao.get())
        // });
        var opcoesMenu = new ComponentPagina
        opcoesMenu.forEach(opcao => {
            let botao = new OpcaoMenu
            if(opcao.onMenu==true) {
            	botao.setNome(opcao.nome)
	            botao.setImg(opcao.img)
	            botao.setLink(opcao.link,opcao.obj)
	            this.divOpcoesMenu.appendChild(botao.get())
            }
        });

        return this.retorno
    }
}

class OpcaoMenu {
    constructor() {
        this.divOpcaoMenu = document.createElement('div')
        this.divOpcaoMenu.setAttribute('class','divOpcaoMenu')

	        this.divOpcaoMenuIcoDiv = document.createElement('div')
	        this.divOpcaoMenuIcoDiv.setAttribute('class','divOpcaoMenuIcoDiv')

        		this.divOpcaoMenuIco = document.createElement('img')

    		this.divOpcaoMenuIcoDiv.appendChild(this.divOpcaoMenuIco)

	        this.divOpcaoMenuTextDiv = document.createElement('div')
	        this.divOpcaoMenuTextDiv.setAttribute('class','divOpcaoMenuTextDiv')

        this.divOpcaoMenu.appendChild(this.divOpcaoMenuIcoDiv)
        this.divOpcaoMenu.appendChild(this.divOpcaoMenuTextDiv)

        this.retorno = this.divOpcaoMenu
    }
    setNome(nome) {
        this.divOpcaoMenuTextDiv.textContent = nome
    }
    setImg(img) {
        this.divOpcaoMenuIco.setAttribute('src',img)
    }
    setLink(pagRef,obj) {
        // this.divOpcaoMenu.setAttribute('onclick','window.location.href="'+pagRef+'"')
        $(this.divOpcaoMenu).click(()=>{
        	let abrePagina = new AbrePagina
        	abrePagina.link(pagRef,obj)
        	let abreFechaMenu = new AbreFechaMenu
            abreFechaMenu.abreFechaMenu()
        })
        
    }
    setId(id) {
        this.divOpcaoMenu.setAttribute('id',id)
    }
    get() {
        return this.retorno
    }
}

class AbreFechaMenu {
	constructor() {
		this.command = ()=>{
			$(document.getElementById('menuOpen')).animate({width:'toggle'},250)
		}
	}
	abreFechaMenu() {
		this.command()
	}
}