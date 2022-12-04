import AbrePagina from './ComponentLinks.js'
import AbreFechaMenu from './ComponentMenu.js'
import PageProfile from './PageProfile.js'

export default class CardLead {
	constructor() {
		this.number = ''
		
		this.divCardLead = document.createElement('a')
		this.divCardLead.setAttribute('class','divCardLead')
		
			this.divCLleft = document.createElement('div')
			this.divCLleft.setAttribute('class','divCLleft')

            this.divCLright = document.createElement('div')
			this.divCLright.setAttribute('class','divCLright')

                this.divCLheader = document.createElement('div')
                this.divCLheader.setAttribute('class','divCLheader')
			
                    this.divCLheaderLeft = document.createElement('div')
                    this.divCLheaderLeft.setAttribute('class','divCLheaderLeft')
                        this.divCLname = document.createElement('p')
                        this.divCLname.setAttribute('class','divCLname')
                        this.divCLnumber = document.createElement('p')
                        this.divCLproduct = document.createElement('p')
                        this.divCLmedia = document.createElement('p')
                        this.divCLmedia.setAttribute('class','divCLmedia')
                    this.divCLheaderLeft.appendChild(this.divCLname)
                    this.divCLheaderLeft.appendChild(this.divCLnumber)
                    this.divCLheaderLeft.appendChild(this.divCLproduct)
                    this.divCLheaderLeft.appendChild(this.divCLmedia)
                    
                    this.divCLheaderRight = document.createElement('div')
                    this.divCLheaderRight.setAttribute('class','divCLheaderRight')
                        this.divCLheaderRightTop = document.createElement('div')
                        this.divCLheaderRightTop.setAttribute('class','divCLheaderRightTop')
                            this.divCLstatus = document.createElement('p')
                            this.divCLstatus.setAttribute('class','divCLstatus')
                            this.divCLtopclient = document.createElement('div')
                            this.divCLtopclient.setAttribute('class','divCLtopclient')
                                this.botTopClientDivImg = document.createElement('img')
                                this.botTopClientDivImg.setAttribute('src','/assets/img/imgBotaoTopClient.png')
                                this.botTopClientDivText = document.createElement('p')
                                this.botTopClientDivText.textContent = 'TOP CLIENT'
                            this.divCLtopclient.appendChild(this.botTopClientDivImg)
                            this.divCLtopclient.appendChild(this.botTopClientDivText)
                        this.divCLheaderRightTop.appendChild(this.divCLstatus)
                        // this.divCLheaderRightTop.appendChild(this.divCLtopclient)
                        this.divCLheaderRightMiddle = document.createElement('div')
                        this.divCLheaderRightMiddle.setAttribute('class','divCLheaderRightMiddle')
                        this.divCLheaderRightBot = document.createElement('div')
                        this.divCLheaderRightBot.setAttribute('class','divCLheaderRightBot')
                            this.divCLdatetime = document.createElement('p')
                        this.divCLheaderRightBot.appendChild(this.divCLdatetime)
                    this.divCLheaderRight.appendChild(this.divCLheaderRightTop)
                    this.divCLheaderRight.appendChild(this.divCLheaderRightMiddle)
                    this.divCLheaderRight.appendChild(this.divCLheaderRightBot)

                this.divCLheader.appendChild(this.divCLheaderLeft)
                this.divCLheader.appendChild(this.divCLheaderRight)
            
            this.divCLright.appendChild(this.divCLheader)
			
		this.divCardLead.appendChild(this.divCLleft)
		this.divCardLead.appendChild(this.divCLright)
	}
	html() {
		return this.divCardLead
	}
	setName(name) {
		this.divCLname.textContent = name
	}
	setProduct(product) {
		this.divCLproduct.textContent = product
	}
	setNumber(number) {
		this.number = number
		let numberMask = ''
		if(number.length!=0) {
			if(number.length<11) {
				numberMask = this.number
				numberMask = numberMask.replace(/^(\d{2})(\d)/g,"($1) $2")
				numberMask = numberMask.replace(/(\d)(\d{4})$/,"$1-$2")
			} else {
				numberMask = this.number
				numberMask = numberMask.replace(/^(\d{3})(\d)/g,"$1 $2")
				numberMask = numberMask.replace(/^(\d{2})(\d)/g,"($1) $2")
				numberMask = numberMask.replace(/(\d)(\d{4})$/,"$1-$2")
			}
		} else {
			numberMask = this.number
		}
		this.divCLnumber.textContent = numberMask
	}
	setMedia(media) {
		this.divCLmedia.textContent = media
	}
	setStatus(status) {
		this.divCLstatus.textContent = status
	}
	setTopClient(topClient) {
		if(topClient) {
			this.divCLheaderRightTop.appendChild(this.divCLtopclient)
		}
	}
	setDateTime(dateTime) {
		// var date = new Date(dateTime)
		// var day = date.getDate() < 10 ? "0" + (date.getDate()) : date.getDate()
		// var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : (date.getMonth() + 1)
		// var year = date.getFullYear().toString().substr(0,4)
		// var hour = date.getHours() < 10 ? "0" + (date.getHours()) : date.getHours()
		// var minute = date.getMinutes() < 10 ? "0" + (date.getMinutes()) : date.getMinutes()
		// var second = date.getSeconds() < 10 ? "0" + (date.getSeconds()) : date.getSeconds()
		// var dateString = day  + "/" + month + "/" + year + " " + hour + ":" + minute
		// this.divCLdatetime.textContent = dateString
		this.divCLdatetime.textContent = dateTime
	}
	setLink(codLead) {
		// this.divCardLead.setAttribute('href','/profile/'+codLead)
		$(this.divCardLead).click(()=>{
        	let abrePagina = new AbrePagina
        	// abrePagina.link('/profile/'+codLead,opcoesMenu)
        	abrePagina.link('/profile/l'+codLead,new PageProfile)
        })
	}
	htmlProfileLead(codLead) {
		this.divCardLead.setAttribute('class','divProfileLead')
		
		this.divCLleft.setAttribute('class','divCLleftProfile')
		
			this.pProfileTitle = document.createElement('img')
			this.pProfileTitle.setAttribute('class','pProfileTitle')
			this.pProfileTitle.setAttribute('src','/assets/img/historico_title.png')
		
		this.divCLleft.appendChild(this.pProfileTitle)
		
		this.divCLMenu = document.createElement('div')
		this.divCLMenu.setAttribute('class','divCLMenu')
		
			this.divCLMenuTop = document.createElement('div')
			this.divCLMenuTop.setAttribute('class','divCLMenuTop')
			
				this.divCLMenuTopLeft = document.createElement('div')
				this.divCLMenuTopLeft.setAttribute('class','divCLMenuTopLeft')
				if (this.number!='') this.divCLMenuTopLeft.setAttribute('onclick','window.open("tel:'+this.number+'")')
				
					this.divCLMenuLigaImg = document.createElement('img')
					this.divCLMenuLigaImg.setAttribute('class','divCLMenuLigaImg')
					this.divCLMenuLigaImg.setAttribute('src','/assets/img/divCLMenuLigaImg.png')
					
					this.divCLMenuLigaTitle = document.createElement('p')
					this.divCLMenuLigaTitle.setAttribute('class','divCLMenuLigaTitle')
					this.divCLMenuLigaTitle.textContent = 'Ligar'
					
				this.divCLMenuTopLeft.appendChild(this.divCLMenuLigaImg)
				this.divCLMenuTopLeft.appendChild(this.divCLMenuLigaTitle)
				
				this.divCLMenuTopCenter = document.createElement('div')
				this.divCLMenuTopCenter.setAttribute('class','divCLMenuTopCenter')
				if (this.number!='') this.divCLMenuTopCenter.setAttribute('onclick','window.open("https://api.whatsapp.com/send?phone=55'+(this.number.substr(0,2))+(this.number.slice(-8))+'")')
				
					this.divCLMenuWhatsImg = document.createElement('img')
					this.divCLMenuWhatsImg.setAttribute('class','divCLMenuWhatsImg')
					this.divCLMenuWhatsImg.setAttribute('src','/assets/img/divCLMenuWhatsImg.png')
					
					this.divCLMenuWhatsTitle = document.createElement('p')
					this.divCLMenuWhatsTitle.setAttribute('class','divCLMenuWhatsTitle')
					this.divCLMenuWhatsTitle.textContent = 'WhatsApp'
					
				this.divCLMenuTopCenter.appendChild(this.divCLMenuWhatsImg)
				this.divCLMenuTopCenter.appendChild(this.divCLMenuWhatsTitle)
				
				this.divCLMenuTopRight = document.createElement('div')
				this.divCLMenuTopRight.setAttribute('class','divCLMenuTopRight')
				
					this.divCLMenuEditImg = document.createElement('img')
					this.divCLMenuEditImg.setAttribute('class','divCLMenuEditImg')
					this.divCLMenuEditImg.setAttribute('src','/assets/img/divCLMenuEditImg.png')
					
					this.divCLMenuEditTitle = document.createElement('p')
					this.divCLMenuEditTitle.setAttribute('class','divCLMenuEditTitle')
					this.divCLMenuEditTitle.textContent = 'Editar'
					
				this.divCLMenuTopRight.appendChild(this.divCLMenuEditImg)
				this.divCLMenuTopRight.appendChild(this.divCLMenuEditTitle)
				
			this.divCLMenuTop.appendChild(this.divCLMenuTopLeft)
			this.divCLMenuTop.appendChild(this.divCLMenuTopCenter)
			this.divCLMenuTop.appendChild(this.divCLMenuTopRight)
			
			this.divCLMenuBot = document.createElement('div')
			this.divCLMenuBot.setAttribute('class','divCLMenuBot')
			
				this.divCLMenuBotImg = document.createElement('img')
				this.divCLMenuBotImg.setAttribute('class','divCLMenuBotImg')
				this.divCLMenuBotImg.setAttribute('src','/assets/img/divCLMenuBotImg.png')
				
				this.divCLMenuBotTxt = document.createElement('p')
				this.divCLMenuBotTxt.setAttribute('class','divCLMenuBotTxt')
				this.divCLMenuBotTxt.textContent = 'Adicionar Histórico'
				
			this.divCLMenuBot.appendChild(this.divCLMenuBotImg)
			this.divCLMenuBot.appendChild(this.divCLMenuBotTxt)
			
		this.divCLMenu.appendChild(this.divCLMenuTop)
		this.divCLMenu.appendChild(this.divCLMenuBot)
		
		this.divCLright.appendChild(this.divCLMenu)
		
		this.divCLHistoricoTitle = document.createElement('div')
		this.divCLHistoricoTitle.setAttribute('class','divCLHistoricoTitle')
		
			this.divCLHistoricoImg = document.createElement('img')
			this.divCLHistoricoImg.setAttribute('class','divCLHistoricoImg')
			this.divCLHistoricoImg.setAttribute('src','/assets/img/divCLHistoricoImg.png')
			
			this.divCLHistoricoTitleTxt = document.createElement('div')
			this.divCLHistoricoTitleTxt.setAttribute('class','divCLHistoricoTitleTxt')
			this.divCLHistoricoTitleTxt.textContent = 'Linha do tempo'
			
		this.divCLHistoricoTitle.appendChild(this.divCLHistoricoImg)
		this.divCLHistoricoTitle.appendChild(this.divCLHistoricoTitleTxt)
		
		this.divCLright.appendChild(this.divCLHistoricoTitle)
		
		this.divHistoricoContainer = document.createElement('div')
		this.divHistoricoContainer.setAttribute('id','divHistoricoContainer')
		
		this.divCLright.appendChild(this.divHistoricoContainer)
		
		$.ajax({
            url:'/assets/exe/getHistorico.php',
            dataType:'json',
            data:{
            	indice:codLead
            },
            method: 'post',
            success:(json)=>{
                for(let i=0;i<json.numResults;i++) {
                	let card = new CardHist
                	card.setStatus(json.pesquisa[i].status)
                	card.setDescricao(json.pesquisa[i].descricao)
                	card.setDateUser(json.pesquisa[i].usuario+" - "+json.pesquisa[i].data)
                	this.divHistoricoContainer.appendChild(card.html())
                }
            }
        })
		
		return this.divCardLead
	}
}

class CardHist {
	constructor() {
		this.cardHistContainer = document.createElement('div')
		this.cardHistContainer.setAttribute('class','cardHistContainer')
		
			this.cardHistStatus = document.createElement('div')
			this.cardHistStatus.setAttribute('class','cardHistStatus')
			
			this.cardHistDescricao = document.createElement('div')
			this.cardHistDescricao.setAttribute('class','cardHistDescricao')
			
			this.cardHistDateUser = document.createElement('div')
			this.cardHistDateUser.setAttribute('class','cardHistDateUser')
			
		this.cardHistContainer.appendChild(this.cardHistStatus)
		this.cardHistContainer.appendChild(this.cardHistDescricao)
		this.cardHistContainer.appendChild(this.cardHistDateUser)
	}
	setStatus(status) {
		this.cardHistStatus.textContent = status
	}
	setDescricao(descricao) {
		this.cardHistDescricao.textContent = descricao
	}
	setDateUser(dateUser) {
		this.cardHistDateUser.textContent = dateUser
	}
	html() {
		return this.cardHistContainer
	}
}









