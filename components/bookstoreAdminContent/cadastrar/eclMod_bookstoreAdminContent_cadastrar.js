
class eclMod_bookstoreAdminContent_cadastrar extends eclMod {
    raw = '';
    fields = {};
    error = {};

    connectedCallback() {
        this.track('error');
        this.track('raw');
        this.track('fields');
    }

    handleAction(event) {
        var action = event.detail.action;
        var formulary = event.detail.formulary;

        if (action === 'save') {
            io.request({ fields: formulary.fields })
                .then(response => {
                    this.fields = response.fields;
                    var path = [...page.application.parent.path, this.fields.name];
                    navigate(page.url(path));
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

}
