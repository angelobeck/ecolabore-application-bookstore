
class eclMod_bookstoreLivros_narradoresDetalhes extends eclMod {
    response = [];
    narrator = {};
    
    connectedCallback() {
        this.track('response');

        io.request()
            .then((response) => {
                if (Array.isArray(response.children))
                this.response = response.children;
            if(response.narrator)
                this.narrator = response.narrator;
            });
    }

    get _children_() {
        var children = [];
        var basePath = page.application.path;
        for (let i = 0; i < this.response.length; i++) {
            let child = this.response[i];

            children.push({
                title: child.text.title,
                description: child.text.description || {},
                url: page.url([...basePath, child.name])
            });
        }
        return children;
    }

}