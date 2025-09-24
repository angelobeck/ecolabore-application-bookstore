
class eclMod_bookstoreAdminContent_editar extends eclMod {
    fields = {};
    raw;
    error = {};
    showFormulary = false;

    connectedCallback() {
        this.track('showFormulary');
        this.track('raw');

        io.request()
            .then(response => {
                this.showFormulary = true;
                this.fields = response.fields;
            });
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;

        if (action === 'save') {
            io.request({ fields: formulary.fields })
                .then(response => {
                    let path = page.application.parent.path;
                    navigate(page.url(path));
                })
                .catch((error, raw) => {
                    this.error = error;
                    if (error.message)
                        page.alertOpen('alert');
                    else
                        this.raw = eclIo_convert.stripTags(raw);
                });

        }
    }

}
