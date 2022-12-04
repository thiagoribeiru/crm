export default class AbrePagina {
	constructor() {
		this.abrePagina = (url)=>{
			history.pushState({}, null, url)
		}
	}
	link(url,obj) {
		this.abrePagina(url)
		let containerCentralDiv = document.querySelector("#containerCentralDiv")
		// let newPage = false
		if (url.replaceAll('/','')!='') {
			// opcoesMenu.forEach(opcao => {
	  //          let linkNome = opcao.link.replaceAll('/','')
	  //          if(url.replaceAll('/','')==linkNome) {
	  //          	newPage = opcao.obj.iniciar()
	  //          	containerCentralDiv.innerHTML = ''
	  //          	containerCentralDiv.appendChild(newPage ? newPage : false)
	  //          }
	  //      });
			containerCentralDiv.innerHTML = ''
			containerCentralDiv.appendChild(obj.iniciar())
		} else {
			containerCentralDiv.innerHTML = ''
		}
	}
}