
class eclMod_bookstoreHome extends eclMod {
    url;

    connectedCallback() {
        this.url = page.url([page.domain.name, 'livros', '-dominio-publico']);
    }

}
