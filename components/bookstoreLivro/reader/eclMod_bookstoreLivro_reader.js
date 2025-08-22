
class eclMod_bookstoreLivro_reader extends eclMod {
    name = '';
    content = '';

    connectedCallback() {
        this.track('content');
    }

    refreshCallback() {
        this.content = '';

        io.request(false, 'main', page.application.path)
            .then((response, raw) => {
                this.content = response.content;
            })
            .catch(error => {
                this.content = error.message;
            });
    }

}
