
class eclMod_bookstoreAdminLivros_detalhes_registro extends eclMod {
    fields = {};
    raw;
    error = {};
    showFormulary = false;

    connectedCallback() {
        this.track('showFormulary');
        this.track('raw');

        io.request()
        .then(fields => {
            this.showFormulary = true;
            this.fields = fields;
        }); 
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;

        if (action === 'save') {
            io.request(formulary.fields)
                .then(fields => {
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

    closeAlert() {
        page.alertClose('alert');
    }

}
