
class eclMod_bookstoreLivros_generosDetalhes extends eclMod {
    response = [];
    genre = {};

    connectedCallback() {
        this.track('response');

        io.request()
            .then((response) => {
                if (Array.isArray(response.children))
                    this.response = response.children;
                if (response.genre)
                    this.genre = response.genre;
            });
    }

    get _children_() {
        var children = [];
        var basePath = page.application.path;
        for (let i = 0; i < this.response.length; i++) {
            let child = this.response[i];

            children.push({
                title: child.text.title,
                author: child.text.author || {},
                url: page.url([...basePath, child.name])
            });
        }
        return children;
    }

}