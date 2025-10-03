
class eclMod_bookstoreLivro extends eclMod {
    book = '';
    files = [];
    isFavorite = false;

    connectedCallback() {
        this.track('book');

        io.request()
            .then(response => {
                this.book = response.book;
                this.files = response.files;
                this.isFavorite = response.is_favorite;
            })
            .catch(error => {
                this.book = error;
            });
    }

    get _urlAuthor_() {
        return page.url([page.domain.name, 'livros', '-autores', this.book.author_name]);
    }

    get _urlCollection_() {
        return page.url([page.domain.name, 'livros', '-series', this.book.collection_name]);
    }

    get _urlNarrator_() {
        return page.url([page.domain.name, 'livros', '-narradores', this.book.narrator_name]);
    }

    get _urlGenre_() {
        return page.url([page.domain.name, 'livros', '-generos', this.book.genre_name]);
    }

    get _keywords_() {
        var keywords = page.selectLanguage(this.book.text.keywords).value.split(',');
        var keysList = [];
        for (let i = 0; i < keywords.length; i++) {
            let key = keywords[i];
            key = key.trim();
            if (key.substring(key.length - 1) === ',')
                key = key.substring(0, key.length - 1);
            if (key.length) {
                let slug = eclIo_convert.slug(key).replace(/[_]/g, '+');
                keysList.push({
                    label: key,
                    separator: keysList.length ? ', ' : '',
                    url: page.url([page.domain.name, 'livros'], true, '_keywords-' + slug)
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

    get _showAdultMessage_() {
        if (!this.book.adult)
            return false;
        if (!page.session.user || !page.session.user.name)
            return true;
        if (page.session.user.groups && page.session.user.groups['-adult'])
            return false;
        else
            return true;
    }

    get _showProtectedMessage_() {
        if (this._showAdultMessage_)
            return false;
        if (this.book.public)
            return false;
        if (page.session.user && page.session.user.name)
            return false;
        else
            return true;
    }

    get _readerEnabled_() {
        if (this._showAdultMessage_ || this._showProtectedMessage_)
            return false;
        for (let i = 0; i < this.files.length; i++) {
            if (this.files[i] === this.book.name + '.txt')
                return true;
        }
        return false;
    }

    get _downloadEnabled_() {
        if (this._showAdultMessage_ || this._showProtectedMessage_)
            return false;
        if (!page.session.user || !page.session.user.name)
            return false;
        if (!page.session.user.groups || !page.session.user.groups['-verified'])
            return false;
        if (this.files.length)
            return true;
        else
            return false;
    }

    get _audiobookEnabled_() {
        if (this._showAdultMessage_ || this._showProtectedMessage_)
            return false;
        else if (this.book.format_audio)
            return true;
        else
            return false;
    }

    get _readers_() {
        if (this.book.adult)
            return [];
        if (!Array.isArray(this.book.details.readers))
            return [];
        return this.book.details.readers.map((reader, index) => {
            var path = [page.application.path[0], 'comunidade', reader.id];
            return {
                title: reader.title,
                url: page.url(path),
                separator: index ? ', ' : ''
            }
        });
    }

    get _showFavoriteButton_() {
        if (!page.session.user || !page.session.user.name)
            return false;
        if (this._showAdultMessage_)
            return false;
        else
            return true;
    }

    actionFavorite() {
        var action = 'favorite_subscribe';
        if (this.isFavorite)
            action = 'favorite_unsubscribe';

        io.request({ action: action })
            .then(response => {
                this.book = response.book;
                this.files = response.files;
                this.isFavorite = response.is_favorite;
                this.paragraphs = page.selectLanguage(this.book.text.synopsis).value.split("\n");
            });
    }

    get _buttonFavoriteLabel_() {
        return this.isFavorite ? "Remover dos meus favoritos" : "Adicionar aos meus favoritos";
    }

}
