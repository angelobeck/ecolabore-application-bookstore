
class eclMod_bookstoreAdminLivros_generosCadastrar extends eclMod {
    response = '';
    input;

    connectedCallback() {
        this.track('response');
    }

    handleClick() {
        io.request()
            .then(received => {
                this.response = serialize(received, true);
            });
    }

}