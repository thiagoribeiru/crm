import PageNovoLead from "./PageNovoLead.js"
import PageLeads from "./PageLeads.js"
import PageProfile from "./PageProfile.js"

export default class ComponentPaginas {
	constructor() {
		this.componentPaginas = [
	    	//modelo basico
	    	// {
	    	// 	onmenu:true/false,
	    	// 	nome:'Leads',
	    	// 	img:'/assets/img/imgMenuOpcaoLeads.png',
	    	// 	link:'/leads/',
	    	// 	obj:new PageLeads
	    	// },
	    	{onMenu:true,nome:'Leads',img:'/assets/img/imgMenuOpcaoLeads.png',link:'/leads/',obj:new PageLeads},
	        {onMenu:true,nome:'Novo Lead',img:'/assets/img/imgMenuOpcaoNovoLead.png',link:'/novo/',obj:new PageNovoLead},
	        {onMenu:false,link:'/profile/',obj:new PageProfile}
	    ]
	    
	    return this.componentPaginas
	}
}