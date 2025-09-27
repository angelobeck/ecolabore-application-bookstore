
class eclMod_bookstoreHome extends eclMod {
    url;
    sections = [];

    connectedCallback() {
        this.track('sections');
        this.url = page.url([page.domain.name, 'livros', '-dominio-publico']);

        io.request()
            .then(response => {
                localStorage.setItem('bookstore_content', serialize(response.children));
                var bookstore_content = store.load('bookstore_content');
                this.sections = bookstore_content.children(0);
            });
    }

    get _sections_() {
        return this.sections.map(section => {
            return {
                title: section.text.title,
                url: page.url([page.domain.name, section.name])
            };
        });
    }

}
