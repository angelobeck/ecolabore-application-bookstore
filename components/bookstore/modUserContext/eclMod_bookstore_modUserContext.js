
class eclMod_bookstore_modUserContext extends eclMod {
    login_url = '';
    subscribe_url = '';
    profile_url = '';
    logout_url = '';
    isConnected = false;

    connectedCallback() {
        this.track('isConnected');
    }

    refreshCallback() {
        if (page.session.user && page.session.user.name) {
            this.isConnected = true;
            this.profile_url = page.url([page.domain.name, 'estante', 'perfil']);
            this.logout_url = page.url(true, true, '_logout');
        } else {
            this.isConnected = false;
            this.login_url = page.url([page.domain.name, 'estante', '-login']);
            this.subscribe_url = page.url([page.domain.name, 'cadastrar']);
        }
    }

    handleLogout() {
        page.session = {};
        page.sessionRemove();
        root.reset();
        init();
    }
}
