export default class FormLogin {
    constructor() {
        var formLoginDiv = document.createElement('div')
        formLoginDiv.setAttribute('class','formLoginDiv')

        var formLoginHeader = document.createElement('div')
        formLoginHeader.setAttribute('class','formLoginHeader')
        formLoginHeader.textContent = 'Entrar'

        formLoginDiv.appendChild(formLoginHeader)
        
        var formLoginError = document.createElement('div')
        formLoginError.setAttribute('id','formLoginError')

        var formLoginErrorText = document.createElement('p')
        formLoginErrorText.setAttribute('class','formLoginErrorText')

        formLoginError.appendChild(formLoginErrorText)
        formLoginDiv.appendChild(formLoginError)

        var formLoginBody = document.createElement('div')
        formLoginBody.setAttribute('class','formLoginBody')

        var formLoginForm = document.createElement('form')
        
        var formLoginUser = document.createElement('input')
        formLoginUser.setAttribute('name','gluser')
        formLoginUser.setAttribute('placeholder','Usuário')
        formLoginUser.setAttribute('type','text')
        formLoginUser.setAttribute('required','required')

        var formLoginPass = document.createElement('input')
        formLoginPass.setAttribute('name','glpass')
        formLoginPass.setAttribute('placeholder','Senha')
        formLoginPass.setAttribute('type','password')
        formLoginPass.setAttribute('required','required')

        var formLoginButton = document.createElement('button')
        formLoginButton.setAttribute('class','formLoginButton')
        formLoginButton.textContent = 'Continuar'

        formLoginForm.appendChild(formLoginUser)
        formLoginForm.appendChild(formLoginPass)
        formLoginForm.appendChild(formLoginButton)
        formLoginBody.appendChild(formLoginForm)
        formLoginDiv.appendChild(formLoginBody)

        $(formLoginButton).click((e)=>{
            e.preventDefault()
            fazLogin()
            
        })

        $(formLoginForm).submit((e)=>{
            e.preventDefault()
            fazLogin()
        })

        const verificaCampo = (campo)=>{
            var ok = true
            if(campo.value=="") {
                campo.setAttribute('class','required')
                ok = false
            } else {
                campo.removeAttribute('class')
            }
            return ok
        }

        const mostraErro = (textErro)=>{
            formLoginErrorText.textContent = textErro
            $(formLoginError).slideDown('slow')
            setTimeout(() => {
                $(formLoginError).slideUp('slow')
            }, 3000);
        }

        var fazLogin = ()=>{
            var c1 = verificaCampo(formLoginUser)
            var c2 = verificaCampo(formLoginPass)
            if(c1&&c2) {
                $.ajax({
                    url: 'assets/exe/fazLogin.php',
                    data: {
                        user:formLoginUser.value,
                        pass:formLoginPass.value
                    },
                    method: 'POST',
                    dataType: 'JSON',
                    beforeSend: ()=>{
                        $(window.formLoginLoader).show()
                        formLoginDiv.style.opacity = '0.5'
                    },
                    success: (json)=>{
                        if(json.ok=='1') {
                            window.location.reload()
                        } else {
                            console.log(json.erro)
                            mostraErro(json.erro)
                        }
                        $(window.formLoginLoader).hide()
                        formLoginDiv.style.opacity = '1'
                    }
                })
            }
        }

        return formLoginDiv
    }
}