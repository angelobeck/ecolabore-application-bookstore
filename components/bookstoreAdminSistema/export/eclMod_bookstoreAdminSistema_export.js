
class eclMod_bookstoreAdminSistema_export extends eclMod {
    response = '';
    fileName;
    
    connectedCallback() {
        this.track('response');
    }

    handleClick() {
        var data = { fileName: 'bookstore' };
        if (this.fileName.value !== '')
            data.fileName = this.fileName.value;

        io.request(data)
            .then(received => {
                this.response = serialize(received, true);
            });
    }

}