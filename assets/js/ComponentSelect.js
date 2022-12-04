export default class Select {
    constructor(nome,option0,classe) {
        this.select = document.createElement('select')
        this.select.setAttribute('name',nome)
        this.select.setAttribute('class',classe)
            this.selectOption0 = document.createElement('option')
            this.selectOption0.setAttribute('value','')
            this.selectOption0.textContent = option0
        this.select.appendChild(this.selectOption0)
        return this.select
    }
}