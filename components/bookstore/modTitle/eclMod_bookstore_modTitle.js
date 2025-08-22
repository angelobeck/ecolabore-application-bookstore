
class eclMod_bookstore_modTitle extends eclMod {
    element;

    get _title_() {
        return page.application.data['text']['title'] || this.page.application.name;
    }

    renderedCallback(){
        this.element.setAttribute('tabindex', '0');
        this.element.focus();
    }

}
