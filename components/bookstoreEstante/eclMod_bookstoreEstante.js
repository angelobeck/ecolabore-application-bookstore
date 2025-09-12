
class eclMod_bookstoreEstante extends eclMod {
    user = {};
    userContent = {};

    connectedCallback() {
        this.track('user');
        this.update();
    }

    update() {
        io.request()
            .then((response) => {
                this.user = response.user;
                this.userContent = response.userContent;
            });
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