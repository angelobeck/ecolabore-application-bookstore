
class eclMod_bookstorePerfil extends eclMod {
    response = {};
    
    connectedCallback() {
        this.track('response');

        io.request()
            .then((response) => {
                this.response = response;
            });
    }

}