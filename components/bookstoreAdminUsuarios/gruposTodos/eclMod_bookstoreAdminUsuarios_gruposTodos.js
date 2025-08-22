
class eclMod_bookstoreAdminUsuarios_gruposTodos extends eclMod {
    response = '';
    path;
    endpoint;
    input;

    connectedCallback() {
        this.track('response');
    }

    handleClick() {
        var path = true;
        if (this.path.value !== '')
            path = this.path.value.split('/');

        var data = false;
        if (this.input.value !== '')
            data = unserialize(this.input.value);

        var endpoint = 'main';
        if (this.endpoint.value !== '')
            endpoint = this.endpoint.value;

        io.request(data, path, endpoint)
            .then(received => {
                this.response = serialize(received, true);
            });
    }

}