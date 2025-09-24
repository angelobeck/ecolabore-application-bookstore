
class eclMod_bookstoreAdminContent_remover extends eclMod {
    ok = '';
    raw = '';

    connectedCallback() {
        this.track('raw');
    }

    handleChange(event) {
        this.ok = event.detail.value;
    }

    handleClick() {
        var data = {'ok': this.ok};

        io.request(data)
        .then(() => {
            navigate(page.url(page.application.parent.parent.path));
        })
        .catch((error, raw) => {
            this.raw = raw;
        });
    }

}
