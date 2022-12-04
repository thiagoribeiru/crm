export default class Input {
    constructor(tipo,nome,placeholder,classe) {
        this.input = document.createElement('input')
        this.input.setAttribute('type',tipo)
        this.input.setAttribute('name',nome)
        this.input.setAttribute('placeholder',placeholder)
        this.input.setAttribute('class',classe)
        return this.input
    }
}