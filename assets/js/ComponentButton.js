export default class Button {
    constructor(texto,id,classe) {
        this.button = document.createElement('button')
        this.button.setAttribute('class',classe)
        this.button.setAttribute('id',id)
        this.button.textContent = texto
        return this.button
    }
}