
class eclMod_bookstoreAdminUsuarios_detalhes_status extends eclMod {
    formulary;
    fields;
    showFormulary = false;
    showAlert = false;
    raw;
    error = {};

    connectedCallback() {
        this.track('showFormulary');
        this.track('showAlert');
        this.track('raw');

        io.request()
            .then(response => {
                this.showFormulary = true;
                this.fields = response;
            })
            .catch((error, raw) => {
                this.error = error;
                if (error.message)
                    page.alertOpen('alert');
                else
                    this.raw = raw;

            });
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;

        if (action === 'save') {
            io.request(formulary.fields)
                .then(fields => {
                    this.fields = fields;
                    navigate(page.url(page.application.parent.path));
                })
                .catch((error, raw) => {
                    this.error = error;
                    if (error.message)
                        page.alertOpen('alert');
                });

        }
    }

    closeAlert() {
        page.alertClose('alert');
    }

}
