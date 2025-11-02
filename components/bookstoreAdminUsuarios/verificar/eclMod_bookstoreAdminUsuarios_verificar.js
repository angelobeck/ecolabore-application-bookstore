
class eclMod_bookstoreAdminUsuarios_verificar extends eclMod {
    user = {};
    userContent = {};
    document = '';
    extension = '';
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
                this.response = response;
                this.user = response.user;
                this.userContent = response.userContent;
                this.document = response.document;
                this.extension = this.document.split('.').pop();
            })
            .catch(error => {
                this.error = true;
            });
    }

    get _urlDocument_() {
                var path = [...page.application.path, 'documento.' + this.extension];
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
