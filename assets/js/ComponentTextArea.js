export default class TextArea {
    constructor(nome,placeholder,classe) {
        this.textarea = document.createElement('textarea')
        this.textarea.setAttribute('name',nome)
        this.textarea.setAttribute('placeholder',placeholder)
        this.textarea.setAttribute('class',classe)
        return this.textarea
    }
}