
class eclMod_bookstoreAdminUsuarios_verificar extends eclMod {
    user = {};
    userContent = {};
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
                this.user = response.user;
                this.userContent = response.userContent;
            })
            .catch(error => {
                this.error = true;
            });
    }

    get _urlDocument_() {
        var path = [...page.application.path, 'documento.jpg'];
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
