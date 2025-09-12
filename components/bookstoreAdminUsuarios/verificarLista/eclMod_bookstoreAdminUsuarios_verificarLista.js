
class eclMod_bookstoreAdminUsuarios_verificarLista extends eclMod {
    response = [];
    showEmptyMessage = false;
    
    connectedCallback() {
        this.track('response');
        this.track('showEmptyMessage');
    
        io.request()
            .then((response, raw) => {
                if (Array.isArray(response.children))
                    this.response = response.children;
                if(this.response.length === 0)
                    this.showEmptyMessage = true;
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
                url: page.url([...basePath, child.user_id])
            });
        }
        return children;
    }

}