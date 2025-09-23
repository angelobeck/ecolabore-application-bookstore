
class eclMod_bookstoreAdminLivros_livrosCadastrar extends eclMod {
    raw;
    error = {};

    connectedCallback() {
        this.track('raw');
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;

        if (action === 'save') {
            io.request(formulary.fields)
                .then(fields => {
                    let path = [...page.application.parent.path, fields.name];
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
