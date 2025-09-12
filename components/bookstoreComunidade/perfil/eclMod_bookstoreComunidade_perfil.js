
class eclMod_bookstoreComunidade_perfil extends eclMod {
    user = {};
    userContent = {};
    nameMonitor = '';

    connectedCallback() {
        this.track('user');
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
                this.user = response.user;
                this.userContent = response.userContent;
            })
            .catch(error => {
                this.error = true;
            });
    }

    get _paragraphs_() {
        var paragraphs = [];
        this.userContent.text.content.pt.value.split("\n").map(line => {
            if (line != '')
                paragraphs.push(line);
        });
        return paragraphs;
    }

    get _favoritesEnabled_() {
        if (this.userContent.details.favorite_books_hide)
            return false;
        if (!Array.isArray(this.userContent.details.favorite_books) || this.userContent.details.favorite_books.length == 0)
            return false;
        else
            return true;
    }

    get _favorites_() {
        if (!Array.isArray(this.userContent.details.favorite_books))
            return [];

        return this.userContent.details.favorite_books.map((favorite, index) => {
            var path = [page.application.path[0], 'livros', favorite.name];
            var url = page.url(path);

            return {
                separator: index ? ', ' : '',
                title: favorite.title,
                url: url
            };
        });
    }

    get _recentsEnabled_() {
        if (this.userContent.details.recent_books_hide)
            return false;
        if (!Array.isArray(this.userContent.details.recent_books) || this.userContent.details.recent_books.length == 0)
            return false;
        else
            return true;
    }

    get _recents_() {
        if (!Array.isArray(this.userContent.details.recent_books))
            return [];

        return this.userContent.details.recent_books.map((recent, index) => {
            var path = [page.application.path[0], 'livros', recent.name];
            var url = page.url(path);

            return {
                separator: index ? ', ' : '',
                title: recent.title,
                url: url
            };
        });
    }

}
