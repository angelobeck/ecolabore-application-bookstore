
class eclMod_bookstoreAdminContent extends eclMod {
    response = [];

    connectedCallback() {
        this.track('response');

        io.request()
            .then(response => {
                this.response = response.children;
            });
    }

    get _children_() {
        return this.response.map(child => {
            var url = page.url([...page.application.path, child.name]);

            return {
                url: url,
                title: child.text.title
            };
        });
    }

}
