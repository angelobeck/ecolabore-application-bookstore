
class eclMod_bookstoreAdminContent_detalhes extends eclMod {
    fields = false;

    connectedCallback() {
        this.track('fields');

        io.request()
            .then(response => {
                this.fields = response.page;
            });
    }

}
