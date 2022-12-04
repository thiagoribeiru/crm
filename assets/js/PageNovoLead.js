import Row from './ComponentRow.js'
import RowReverse from './ComponentRowReverse.js'
import Input from './ComponentInput.js'
import Select from './ComponentSelect.js'
import TextArea from './ComponentTextArea.js'
import Button from './ComponentButton.js'
import AbrePagina from './ComponentLinks.js'
import PageProfile from './PageProfile.js'

export default class PageNovoLead {
    constructor() {
        this.estadoSelect = ""

        this.containerPagina = document.createElement('div')
        this.containerPagina.setAttribute('class','containerPagina')

            this.rowTitle = new Row
                this.pageTitleH1 = document.createElement('h1')
                this.pageTitleH1.setAttribute('class','pageTitleH1')
                this.pageTitleH1.textContent = 'Novo Lead'
            this.rowTitle.appendChild(this.pageTitleH1)

            this.form = document.createElement('form')
            this.form.setAttribute('id','formNovoLead')

                this.row1 = new Row
                    this.inputNome = new Input('text','nome','Nome Completo','input100')
                    this.alertaNome = new AlertaInput
                this.row1.appendChild(this.inputNome)
                this.row1.appendChild(this.alertaNome.obj)

                this.row2 = new Row
                    this.inputContato = new Input('text','contato','Contato','input100')
                    this.inputContato.setAttribute('inputmode','numeric')
                    this.alertaContato = new AlertaInput
                this.row2.appendChild(this.inputContato)
                this.row2.appendChild(this.alertaContato.obj)

                this.row3 = new Row
                    this.inputEmail = new Input('email','email','E-mail','input100')
                    this.alertaEmail =  new AlertaInput
                this.row3.appendChild(this.inputEmail)
                this.row3.appendChild(this.alertaEmail.obj)

                this.row4 = new Row
                    this.inputCampanha = new Select('campanha','Campanha','input100')
                    this.inputMidia = new Select('midia','Mídia','input100')
                    this.alertaMidia = new AlertaInput
                this.row4.appendChild(this.inputCampanha)
                this.row4.appendChild(this.inputMidia)
                this.row4.appendChild(this.alertaMidia.obj)

                this.row5 = new Row
                    this.inputInteresse = new Select('interesse','Produto de Interesse','input100')
                this.row5.appendChild(this.inputInteresse)

                this.row6 = new Row
                
                    this.inputDivCep = document.createElement('div')
                        this.inputCep = new Input('text','cep','CEP','input100')
                        this.alertaCep = new AlertaInput
                    this.inputDivCep.appendChild(this.inputCep)
                    this.inputDivCep.appendChild(this.alertaCep.obj)
                    this.inputDivCep.setAttribute('class','input100Div')

                    this.inputDivEstado = document.createElement('div')
                        this.inputEstado = new Select('estado','Estado','input100')
                    this.inputDivEstado.appendChild(this.inputEstado)
                    this.inputDivEstado.setAttribute('class','input100Div')

                this.row6.appendChild(this.inputDivCep)
                this.row6.appendChild(this.inputDivEstado)

                this.row7 = new Row                    
                    this.inputCidade = new Select('cidade','Cidade','input100')
                    this.inputCidade.setAttribute('disabled','disabled')
                this.row7.appendChild(this.inputCidade)

                this.row8 = new Row
                    this.inputEndereco = new Input('text','endereco','Endereço','input100')
                this.row8.appendChild(this.inputEndereco)

                this.row9 = new Row
                    this.inputNumResidencia = new Input('text','numResidencia','Número residência','input100')
                    this.inputComplemento = new Input('text','complemento','Complemento','input100')                    
                this.row9.appendChild(this.inputNumResidencia)
                this.row9.appendChild(this.inputComplemento)

                this.row10 = new Row
                    this.inputRg = new Input('text','rg','RG','input100')
                    this.inputCpf = new Input('text','cpf','CPF','input100')                    
                this.row10.appendChild(this.inputRg)
                this.row10.appendChild(this.inputCpf)

                this.row11 = new Row
                    this.inputObservacoes = new TextArea('observacoes','Observações','input100')
                this.row11.appendChild(this.inputObservacoes)

                this.row12 = new RowReverse
                    this.formNovoLeadSave = new Button('SALVAR','formNovoLeadSave','button100')
                    this.formNovoLeadCancel = new Button('CANCELAR','formNovoLeadCancel','button100 buttonFalse')
                this.row12.appendChild(this.formNovoLeadSave)
                this.row12.appendChild(this.formNovoLeadCancel)

            this.form.appendChild(this.row1)
            this.form.appendChild(this.row2)
            this.form.appendChild(this.row3)
            this.form.appendChild(this.row4)
            this.form.appendChild(this.row5)
            this.form.appendChild(this.row6)
            this.form.appendChild(this.row7)
            this.form.appendChild(this.row8)
            this.form.appendChild(this.row9)
            this.form.appendChild(this.row10)
            this.form.appendChild(this.row11)
            this.form.appendChild(this.row12)
        
        this.containerPagina.appendChild(this.rowTitle)
        this.containerPagina.appendChild(this.form)
    }
    iniciar() {
    	$(this.form).submit((event)=>{
            event.preventDefault()
            this.formSubmit()
        })

        $(this.formNovoLeadCancel).click(()=>{
            event.preventDefault()
            window.history.back()
        })

        $(this.formNovoLeadSave).click((event)=>{
            event.preventDefault()
            this.formSubmit()
        })

        $(this.inputNome).blur(()=>{
            if(this.inputNome.value=='') {
                this.alertaNome.alerta('Campo obrigatório')
                $(this.inputNome).focus()
            }
        })

        $(this.inputContato).blur(()=>{
            let v = this.inputContato.value.replace(/[^0-9]+/g,'')
            if(v.length==0) {
                this.alertaContato.alerta('Campo obrigatório')
                $(this.inputContato).focus()
            } else {
                if(v.length<3 || (v[2]<8 && v.length<10) || (v[2]>=8 && v.length<11)) {
                    this.alertaContato.alerta('Número incorreto')
                    $(this.inputContato).focus()
                }
            }
        })

        $(this.inputContato).mask('(00) 0 0000-0000');
        $(this.inputContato).keydown((e)=>{
            let k = e.key
            let v = this.inputContato.value.replace(/[^0-9]+/g,'')
            if(Number(k) && v.length==2) {
                if(k<8) {
                    $(this.inputContato).mask('(00) 0000-0000');
                } else {
                    $(this.inputContato).mask('(00) 0 0000-0000');
                }
            }
        })

        $(this.inputEmail).blur(()=>{
            let field = this.inputEmail
            let usuario = field.value.substring(0, field.value.indexOf("@"));
            let dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
            
            if (field.value.length>=1 && !((usuario.length >=1) &&
                (dominio.length >=3) &&
                (usuario.search("@")==-1) &&
                (dominio.search("@")==-1) &&
                (usuario.search(" ")==-1) &&
                (dominio.search(" ")==-1) &&
                (dominio.search(".")!=-1) &&
                (dominio.indexOf(".") >=1)&&
                (dominio.lastIndexOf(".") < dominio.length - 1))) {
                    $(this.inputEmail).focus()
                    this.alertaEmail.alerta('E-mail incorreto')
            }
        })  
        
        $(this.inputMidia).blur(()=>{
            if(this.inputMidia.value=='') {
                this.alertaMidia.alerta('Campo obrigatório')
                $(this.inputMidia).focus()
            }
        })

        $(this.inputEstado).blur(()=>{
            this.estadoChange(this.inputEstado.value)
        })

        $(this.inputEstado).change(()=>{
            this.estadoChange(this.inputEstado.value)
        })

        $(this.inputCep).blur(()=>{
            if(this.inputCep.value!='') {
                var cep = $(this.inputCep).val().replace(/\D/g, '');
                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;
                    if(validacep.test(cep)) {
                        this.inputEstado.setAttribute('disabled','disabled')
                        this.inputCidade.setAttribute('disabled','disabled')
                        $.ajax({
                            url:"https://viacep.com.br/ws/"+ cep +"/json/?callback=?",
                            dataType:'json',
                            success:(json)=>{
                                console.log(json)
                                if (!("erro" in json)) {
                                    this.getCidades(json.uf,json.localidade)
                                    $(this.inputEstado).removeAttr('disabled')
                                    // $(this.inputCidade).removeAttr('disabled')
                                    $(this.inputEstado).find(":selected").removeAttr('selected')
                                    $(this.inputEstado).find("option[sigla='"+json.uf+"']").attr('selected',true)    
                                    // this.inputEstado.setAttribute('disabled','disabled')   
                                    this.inputEndereco.value = json.logradouro
                                    $(this.inputEndereco).focus()
                                } else {
                                    // limpa_formulário_cep();
                                    // alert("CEP não encontrado.");
                                    this.alertaCep.alerta("CEP não encontrado")
                                    $(this.inputCep).focus()
                                    $(this.inputEstado).removeAttr('disabled')
                                    if(this.estadoSelect!='') {
                                        $(this.inputCidade).removeAttr('disabled')
                                    }
                                }
                            }
                        })
                    } else {
                        // limpa_formulário_cep();
                        // alert("Formato de CEP inválido.");
                        this.alertaCep.alerta("CEP inválido")
                        $(this.inputCep).focus()
                    }
                }
            } else {
                // $(this.inputEstado).removeAttr('disabled')
                if(this.inputEstado.value!='') {
                    // $(this.inputCidade).removeAttr('disabled')
                } else {
                    // this.inputCidade.setAttribute('disabled','disabled')
                }
            }
        })

        $.ajax({
            url:'/assets/exe/getCampanhas.php',
            dataType:'json',
            success:(json)=>{
                let option = ""
                json.forEach(campanha => {
                    option = document.createElement('option')
                    option.setAttribute('value',campanha.codigo)
                    option.textContent = campanha.nome

                    this.inputCampanha.appendChild(option)
                });
            }
        })

        $.ajax({
            url:'/assets/exe/getMidias.php',
            dataType:'json',
            success:(json)=>{
                let option = ""
                json.forEach(midia => {
                    option = document.createElement('option')
                    option.setAttribute('value',midia.codigo)
                    option.textContent = midia.nome

                    this.inputMidia.appendChild(option)
                });
            }
        })

        $.ajax({
            url:'/assets/exe/getProdutos.php',
            dataType:'json',
            success:(json)=>{
                let option = ""
                json.forEach(produto => {
                    option = document.createElement('option')
                    option.setAttribute('value',produto.codigo)
                    option.textContent = produto.nome

                    this.inputInteresse.appendChild(option)
                });
            }
        })

        $.ajax({
            url:'/assets/exe/getEstados.php',
            dataType:'json',
            success:(json)=>{
                let option = ""
                json.forEach(estado => {
                    option = document.createElement('option')
                    option.setAttribute('value',estado.indice)
                    option.setAttribute('sigla',estado.sigla)
                    option.textContent = estado.estado

                    this.inputEstado.appendChild(option)
                });
            }
        })

        this.estadoChange = (estadoValue)=>{
            if(estadoValue!=this.estadoSelect) {
                this.estadoSelect = estadoValue
                if(estadoValue!='') {
                    this.getCidades($(this.inputEstado).find(':selected').attr('sigla'))
                } else {
                    let options = $(this.inputCidade).find("option[auto='auto']")
                    for (let i = 0; i < options.length; i++) {
                        $(options[i]).remove()
                    }
                    // this.inputCidade.setAttribute('disabled','disabled')
                }
            }
        }

        this.getCidades = (sigla,autoPre=false)=>{
            this.inputCidade.setAttribute('disabled','disabled')
            let options = $(this.inputCidade).find("option[auto='auto']")
            for (let i = 0; i < options.length; i++) {
                $(options[i]).remove()
            }
            let quant = 0
            $.ajax({
                url:'/assets/exe/getCidades.php',
                dataType:'json',
                data:{
                    siglaEstado:sigla
                },
                method:'POST',
                success:(json)=>{
                    let option = ""
                    json.forEach(cidade => {
                        option = document.createElement('option')
                        option.setAttribute('value',cidade.indice)
                        option.setAttribute('auto','auto')
                        option.textContent = cidade.cidade
                        if(autoPre && autoPre==cidade.cidade) {
                            option.setAttribute('selected','selected')
                            quant++
                        }
                        this.inputCidade.appendChild(option)
                    });
                    // if(quant!=0) {
                    //     this.inputCidade.setAttribute('disabled','disabled')
                    //     $(this.inputEndereco).focus()
                    // } else {
                    //     $(this.inputCidade).removeAttr('disabled')
                    //     $(this.inputCidade).focus()
                    // }
                    $(this.inputCidade).removeAttr('disabled')
                    $(this.inputCidade).focus()
                }
            })
        }

        this.formSubmit = ()=>{
            let formValsArray = $(this.form).serializeArray()
            var formVals = {}
            let textContentSaveButton = ''       
            $.map(formValsArray, function(n, i){
                formVals[n['name']] = n['value']
            })
            if(formVals.nome!='' && formVals.contato!='' && formVals.midia!='') {
                $.ajax({
                    url:'/assets/exe/setNovoLead.php',
                    dataType:'json',
                    data:formVals,
                    method:'POST',
                    beforeSend:()=>{
                        this.trancaForm()
                        textContentSaveButton = this.formNovoLeadSave.textContent
                        this.formNovoLeadSave.textContent = 'AGUARDE...'
                    },
                    success:(json)=>{
                        if(json.ok) {
                            // window.location.href = '/'
                            this.destrancaForm()
                            let abrePagina = new AbrePagina
				        	abrePagina.link('/profile/l'+json.id,new PageProfile)
                        }
                    },
                    error:(erro)=>{
                        this.destrancaForm()
                        this.formNovoLeadSave.textContent = textContentSaveButton
                        console.log(erro)
                    }
                })
            } else {
                if(formVals.nome=='') this.alertaNome.alerta('Nome obrigatório')
                if(formVals.contato=='') this.alertaContato.alerta('Contato obrigatório')
                if(formVals.midia=='') this.alertaMidia.alerta('Mídia obrigatória')
            }
        }

        this.campoObjDisabled = {}
        this.trancaForm = ()=>{
            let camposFind = $(this.form).find('input, select, textarea, button')
            for(let i=0;i<camposFind.length;i++) {
                this.campoObjDisabled[$(camposFind[i]).attr('name')] = $(camposFind[i]).attr('disabled')
                camposFind[i].setAttribute('disabled','disabled')
            }
        }

        this.destrancaForm = ()=>{
            let camposFind = $(this.form).find('input, select, textarea, button')
            for(let i=0;i<camposFind.length;i++) {
                if(this.campoObjDisabled[$(camposFind[i]).attr('name')]==undefined) {
                    $(camposFind[i]).removeAttr('disabled')
                }
            }
        }

        return this.containerPagina
    }
}

class AlertaInput {
    constructor() {
        this.alertaDiv = document.createElement('div')
        this.alertaDiv.setAttribute('class','alertaInputTop')

        this.time = true

        this.instance = {
            obj: this.alertaDiv,
            alerta: (txt)=>{
                this.alertaDiv.textContent = txt
                if(this.time) {
                    this.time = false
                    $(this.alertaDiv).fadeIn(500).delay(2000).fadeOut(500,()=>{
                        this.time = true
                    })
                }
            }
        }

        return this.instance
    }
}