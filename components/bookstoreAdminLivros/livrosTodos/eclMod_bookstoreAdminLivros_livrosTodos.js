
class eclMod_bookstoreAdminLivros_livrosTodos extends eclMod {
    books = [];
    raw = '';
    
    connectedCallback() {
        this.track('books');
        this.track('raw');

        io.request()
            .then((response) => {
                if (Array.isArray(response.children))
                this.books = response.children;
            })
            .catch((message, raw) => {
                this.raw = raw;
            });
    }

    get _children_() {
        var children = [];
        var basePath = page.application.parent.path;
        for (let i = 0; i < this.books.length; i++) {
            let child = this.books[i];

            children.push({
                title: child.text.title,
                description: child.text.description || {},
                url: page.url([...basePath, child.name])
            });
        }
        return children;
    }

}