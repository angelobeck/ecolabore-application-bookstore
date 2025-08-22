
class eclMod_bookstoreLivro_download extends eclMod {
    book = '';
    paragraphs = [];

    connectedCallback() {
        this.track('book');

        io.request()
            .then(book => {
                this.book = book;
                this.paragraphs = page.selectLanguage(this.book.text.synopsis).value.split("\n");
            })
            .catch(error => {
                this.book = error;
            });
    }

    get _urlAuthor_() {
        return page.url([page.domain.name, 'livros', '-autores', this.book.author_name]);
    }

    get _urlNarrator_() {
        return page.url([page.domain.name, 'livros', '-narradores', this.book.narrator_name]);
    }

    get _urlGenre_() {
        return page.url([page.domain.name, 'livros', '-generos', this.book.genre_name]);
    }

    get _keywords_() {
        var keywords = page.selectLanguage(this.book.text.keywords).value.split(' ');
        var keysList = [];
        for (let i = 0; i < keywords.length; i++) {
            let key = keywords[i];
            key = key.trim();
            if (key.substring(key.length - 1) === ',')
                key = key.substring(0, key.length - 1);
            if (key.length) {
                keysList.push({
                    label: key,
                    url: page.url([page.domain.name, 'livros'], true, '_keywords-' + key)
                })
            }
        }
        return keysList;
    }

    get _urlAudiobook_() {
        return page.url([...page.application.path, 'audiobook']);
    }

    get _urlReader_() {
        return page.url([...page.application.path, 'reader']);
    }

    get _urlDownload_() {
        return page.url([...page.application.path, 'download']);
    }

}
