
class eclMod_bookstoreLivros_seriesDetalhes extends eclMod {
    books = [];
    collection = {};
    nameMonitor = '';

    connectedCallback() {
        this.track('books');
    }

    refreshCallback() {
        if (this.nameMonitor == page.application.name)
            return;

        io.request()
            .then(response => {
                if (response.books)
                    this.books = response.books;
            });
    }

    get _children_() {
        if (!Array.isArray(this.books))
            return [];

        var basePath = [page.domain.name, 'livros'];
        return this.books.map(book => {
            return {
                title: book.text.title,
                url: page.url([...basePath, book.name])
            };
        });

    }

}