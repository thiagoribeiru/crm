export default class Row {
    constructor() {
        this.row = document.createElement('div')
        this.row.setAttribute('class','row')
        return this.row
    }
}