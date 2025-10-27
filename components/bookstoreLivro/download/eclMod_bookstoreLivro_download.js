
class eclMod_bookstoreLivro_download extends eclMod {
    message = '';
    files = [];
    nameMonitor = '';

    connectedCallback() {
        this.track('message');
        this.track('files');

        io.request()
            .then(response => {
                if (response.message)
                    this.message = response.message;
                if (response.files)
                    this.files = response.files;
            })
            .catch(error => {
                if(error.message) {
                    var message = store.staticContent.open(error.message);
                    if(message)
                        this.message = message;
                }
            });
    }

    get _files_() {
        if (!Array.isArray(this.files))
            return [];

        return this.files.map(file => {
            var url = page.url([...page.application.path, file.name]);
            return {
                name: file.name,
                size: ' ' + this.roundBytes(file.size),
                url: url
            };
        });
    }

    roundBytes(size) {
        if (size < 1024)
            return size + 'B';

        size /= 1024;
        if (size < 10)
            return (Math.ceil(size * 10) / 10) + 'KB';
        if (size < 1024)
            return Math.ceil(size) + 'KB';

        size /= 1024;
        if (size < 10)
            return (Math.ceil(size * 10) / 10) + 'MB';
        if (size < 1024)
            return Math.ceil(size) + 'MB';

        size /= 1024;
        if (size < 100)
            return (Math.ceil(size * 10) / 10) + 'GB';
        return Math.ceil(size) + 'GB';
    }

}
