import Row from './ComponentRow.js'
import CardLead from './ComponentCardLead.js'

export default class PageLeads {
    constructor() {
    	
    }
    iniciar() {
    	let pathname = window.location.pathname;
        let splitPath = pathname.split('/');
        this.pageLead = splitPath[2]=='' ? true : false;
    	
        this.containerPagina = document.createElement('div')
        this.containerPagina.setAttribute('class','containerPagina')
    	
	    	this.rowTitle = new Row
	            this.pageTitleH1 = document.createElement('h1')
	            this.pageTitleH1.setAttribute('class','pageTitleH1')
	            this.pageTitleH1.textContent = 'Leads'
	        this.rowTitle.appendChild(this.pageTitleH1)
	        
	        this.rowFiltroPesq = new Row
	        	
	        	this.inputFiltroPesq = document.createElement('div')
	        	this.inputFiltroPesq.setAttribute('class','divInputCont')
	        	
		        	this.lupaPesquisa = document.createElement('img')
		        	this.lupaPesquisa.setAttribute('src','/assets/img/imgInputLupa.png')
		        	
		        	this.inputPesquisa = document.createElement('div')
		        	this.inputPesquisa.setAttribute('class','divInput')
		        	this.inputPesquisa.setAttribute('contenteditable','true')
		        	this.inputPesquisa.setAttribute('placeholder','Pesquisar e filtrar')
		        	
		        this.inputFiltroPesq.appendChild(this.lupaPesquisa)
		        this.inputFiltroPesq.appendChild(this.inputPesquisa)
	        	
	        this.rowFiltroPesq.appendChild(this.inputFiltroPesq)
	        
	        this.rowCardsCont = new Row
	        
	        	this.divCardsCont = document.createElement('div')
	        	this.divCardsCont.setAttribute('class','divCardsCont')
		    		
	    	this.rowCardsCont.appendChild(this.divCardsCont)
    	
    	this.containerPagina.appendChild(this.rowTitle)
        this.pageLead ? this.containerPagina.appendChild(this.rowFiltroPesq) : false
        this.containerPagina.appendChild(this.rowCardsCont)
        
    	jQuery(function($){
		    $("[contenteditable]").focusout(function(){
		        var element = $(this);        
		        if (!element.text().trim().length) {
		            element.empty();
		        }
		    });
		});
		
		if(this.pageLead) {
			this.divCardsCont.innerHTML = ''
			$.ajax({
	            url:'/assets/exe/getLeads.php',
	            dataType:'json',
	            success:(json)=>{
	                for(let i=0;i<json.numResults;i++) {
	                	let card = new CardLead
	                	card.setName(json.pesquisa[i].nome)
	                	card.setProduct(json.pesquisa[i].interesse)
	                	card.setNumber(json.pesquisa[i].contato)
	                	card.setMedia(json.pesquisa[i].midia)
	                	card.setStatus(json.pesquisa[i].status)
	                	// card.setTopClient(json.pesquisa[i].nome)
	                	card.setDateTime(json.pesquisa[i].data)
	                	card.setLink(json.pesquisa[i].indice)
	                	this.divCardsCont.appendChild(card.html())
	                }
	            }
	        })
		}

        return this.containerPagina
    }
}









