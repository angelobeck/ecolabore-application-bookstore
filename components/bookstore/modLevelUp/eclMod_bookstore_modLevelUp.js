
class eclMod_bookstore_modLevelUp extends eclMod {
    url;
    label;
    showModule = false;
    mostrar = '';

    refreshCallback() {
        this.showModule = false;
        this.mostrar = 'não';

        var parent = page.application.parent;
        if (parent.applicationName === 'bookstore')
            return;

        this.url = page.url(parent.path);
        this.label = parent.data.text.title || 'um nível acima';
        this.showModule = true;
        this.mostrar = 'sim';
    }

}
