
class eclMod_bookstoreLivro_reader extends eclMod {
    name = '';
    content = '';
    errorMessage = false;

    connectedCallback() {
        this.track('content');
        this.track('errorMessage');
    }

    refreshCallback() {
        this.content = '';
        this.errorMessage = false;

        io.request(false, 'main', page.application.path)
            .then((response, raw) => {
                this.content = response.content;
            })
            .catch(error => {
                let message = store.staticContent.open(error.message);
                if(message)
                this.errorMessage = message;
            });
    }

}
