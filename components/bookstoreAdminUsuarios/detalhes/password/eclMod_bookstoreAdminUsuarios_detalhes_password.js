
class eclMod_bookstoreAdminUsuarios_detalhes_password extends eclMod {
    raw;
    error = {};
    fields = {};

    connectedCallback() {
        this.track('raw');
        this.track('fields');
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;
        this.fields = formulary.fields;

        if (action === 'save') {
            io.request(formulary.fields)
                .then(() => {
                    navigate(page.url(page.application.parent.path));
                })
                .catch((error, raw) => {
                    this.error = error;
                    if (error.message)
                        page.alertOpen('alert');
                    else
                        this.raw = raw;
                });

        }
    }

    closeAlert() {
        page.alertClose('alert');
    }

}
