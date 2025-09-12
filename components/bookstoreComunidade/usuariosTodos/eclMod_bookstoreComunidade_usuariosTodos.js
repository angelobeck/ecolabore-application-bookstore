
class eclMod_bookstoreComunidade_usuariosTodos extends eclMod {
    response = [];
    
    connectedCallback() {
        this.track('response');
    
        io.request()
            .then((response, raw) => {
                if (Array.isArray(response.children))
                    this.response = response.children;
            });
    }

    get _children_() {
        var children = [];
        var basePath = page.application.parent.path;
        for (let i = 0; i < this.response.length; i++) {
            let child = this.response[i];

            children.push({
                title: child.text.title,
                description: child.text.description || {},
                url: page.url([...basePath, child.user_id])
            });
        }
        return children;
    }

}