
class eclMod_bookstoreHome extends eclMod {
    url;
    sections = [];
    recents = [];
    mensageria = {};

    connectedCallback() {
        this.track('sections');
        this.track('mensageria');
        this.url = page.url([page.domain.name, 'livros', '-dominio-publico']);

        io.request()
            .then(response => {
                this.recents = response.recents;
                this.mensageria = response.mensageria;
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

    get _recents_() {
            return this.recents.map(book => {
            return {
                title: book.text.title,
                author: book.text.author,
                url: page.url([page.domain.name, 'livros',  book.name])
            };
        });
    }

}
