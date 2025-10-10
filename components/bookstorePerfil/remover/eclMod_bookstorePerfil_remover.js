
class eclMod_bookstorePerfil_remover extends eclMod {
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
                page.session.user = {};
                page.sessionUpdate();
                page.domain.reset();
            navigate(page.url([page.domain.name]));
        })
        .catch((error, raw) => {
            this.raw = raw;
        });
    }

    get _urlPolitica_() {
        return page.url([page.domain.name, 'privacidade']);
    }
}
