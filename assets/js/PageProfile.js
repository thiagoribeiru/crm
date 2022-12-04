import Row from './ComponentRow.js'
import CardLead from './ComponentCardLead.js'

export default class PageProfile {
    iniciar() {
    	this.containerPagina = document.createElement('div')
        this.containerPagina.setAttribute('class','containerPagina')
        
	        this.rowTitle = new Row
	            this.pageTitleH1 = document.createElement('h1')
	            this.pageTitleH1.setAttribute('class','pageTitleH1')
	            this.pageTitleH1.textContent = 'Leads'
	        this.rowTitle.appendChild(this.pageTitleH1)
	        
	        this.rowCardsCont = new Row
	        this.rowCardsCont.classList.add('rowDivCardsCont')
	        
	        	this.divCardsCont = document.createElement('div')
	        	this.divCardsCont.setAttribute('class','divCardsCont')
		    		
	    	this.rowCardsCont.appendChild(this.divCardsCont)
        
        this.containerPagina.appendChild(this.rowTitle)
        this.containerPagina.appendChild(this.rowCardsCont)
    	
    	 jQuery(function($){
		    $("[contenteditable]").focusout(function(){
		        var element = $(this);        
		        if (!element.text().trim().length) {
		            element.empty();
		        }
		    });
		});
		
		this.pathname = window.location.pathname
        this.splitPath = this.pathname.split('/')
        this.urlGet = this.splitPath[2]
        
        if(this.urlGet[0]=='l') {
    		let codLead = this.urlGet.replace('l','')
    		$.ajax({
	            url:'/assets/exe/getProfile.php',
	            dataType:'json',
	            data:{
	            	indice:codLead
	            },
	            method: 'post',
	            success:(json)=>{
	                for(let i=0;i<json.numResults;i++) {
	                	let card = new CardLead
	                	card.setName(json.pesquisa[i].nome)
	                	card.setProduct(json.pesquisa[i].interesse)
	                	card.setNumber(json.pesquisa[i].contato)
	                	card.setMedia(json.pesquisa[i].midia)
	                	card.setStatus(json.pesquisa[i].status)
	                	// card.setTopClient(json.pesquisa[i].nome)
	                	// card.setDateTime(json.pesquisa[i].data)
	                	// card.setLink(json.pesquisa[i].indice)
	                	this.divCardsCont.appendChild(card.htmlProfileLead(json.pesquisa[i].indice))
	                }
	            }
	        })
    	}

        return this.containerPagina
    }
}







