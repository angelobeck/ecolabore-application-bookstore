
class eclMod_bookstoreAdminAvisos_mensageria extends eclMod {
    mensageria;
    data;

    connectedCallback() {
        this.track('data');


        io.request().then(data => {
            this.data = data;
            this.content = this.data.content;
        });
    }
        
    handleClick() {
        io.request({ content: this.mensageria.value })
            .then((data, raw) => {

            })
            .catch((error, raw) => {

            });
    }

}
