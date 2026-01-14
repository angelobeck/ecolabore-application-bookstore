
class eclMod_bookstoreAdminUsuarios_detalhes_status extends eclMod {
    user = {};
    userContent = {};
    document = '';
    extension = '';

    connectedCallback() {
        this.track('user');

        io.request()
            .then((response, raw) => {
                this.user = response.user;
                this.userContent = response.userContent;
                this.document = response.document;
                this.extension = this.document.split('.').pop();
            })
            .catch(error => {
                this.response = error;
            });
    }

    update() {
        io.request()
            .then((response, raw) => {
                this.user = response.user;
                this.userContent = response.userContent;
                this.document = response.document;
                this.extension = this.document.split('.').pop();
            })
            .catch(error => {
                this.response = error;
            });

    }

    action(event) {
        io.request({ action: event.detail.value })
            .then((response, raw) => {
                this.user = response.user;
                this.userContent = response.userContent;
                this.document = response.document;
                this.extension = this.document.split('.').pop();
            })
            .catch(error => {
                this.response = error;
            });

    }
    get _urlDocument_() {
        var path = [...page.application.parent.path, 'documento.' + this.extension];
        return page.url(path);
    }

    actionAccept() {
        io.request({ action: "accept" })
            .then(() => {
                navigate(page.url(page.application.parent.path));
            });
    }

    actionReject() {
        io.request({ action: "reject" })
            .then(() => {
                navigate(page.url(page.application.parent.path));
            });
    }

}
