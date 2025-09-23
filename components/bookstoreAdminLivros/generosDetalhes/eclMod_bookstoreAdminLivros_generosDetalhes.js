
class eclMod_bookstoreAdminLivros_generosDetalhes extends eclMod {
    register = {};
    books = [];
    nameMonitor = '';

    connectedCallback() {
        this.track('register');
    }

    refreshCallback() {
        if (this.nameMonitor !== page.application.name) {
            this.nameMonitor = page.application.name;
            this.update();
        }
    }

    update() {
        io.request()
            .then(response => {
                this.register = response.register;
                this.books = response.books;
            })
            .catch(error => {
                this.book = error;
            });
    }

    get _books_() {
        var path = [page.domain.name, 'admin', 'livros'];
        if (!Array.isArray(this.books))
            return [];

        return this.books.map(book => {
            return {
                title: book.text.title,
                url: page.url([...path, book.name])
            };
        });
    }

    get _booksExists_() {
        if (!Array.isArray(this.books))
            return false;

        return this.books.length > 0;
    }

}
