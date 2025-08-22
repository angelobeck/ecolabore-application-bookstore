
class eclMod_bookstoreAdminSistema_php extends eclMod {
    inputElement;
    outputElement;

    handleClick() {
        io.request({ content: this.inputElement.value })
            .then((data, raw) => {
                this.outputElement.value = raw;
            })
            .catch((error, raw) => {
                this.outputElement.value = raw;
            });
    }

}