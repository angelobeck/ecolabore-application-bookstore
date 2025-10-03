
class eclStore_bookstoreLivro_audioBookmark {
    data = {
        children: []
    };

    currentConfiguration(bookName) {
        var serialized = localStorage.getItem('bookstoreLivro_audioBookmark');
        if (serialized) {
            this.data = JSON.parse(serialized);
            if (!Array.isArray(this.data.children))
                this.data.children = [];

            for (let i = 0; i < this.data.children.length; i++) {
                const book = this.data.children[i];
                if (book.name === bookName) {
                    return book.currentConfiguration || {};
                }
            }
        }
        return {};
    }

    updateConfiguration(bookName, currentConfiguration) {
        var index = -1;
        for (let i = 0; i < this.data.children.length; i++) {
            const book = this.data.children[i];
            if (book.name === bookName) {
                index = i;
                break;
            }
        }
        if (index == -1)
            index = this.data.children.length;

        this.data.children[index].name = bookName;
        this.data.children[index].currentConfiguration = currentConfiguration;
var serialized = JSON.stringify(this.data);
        localStorage.setItem('bookstoreLivro_audioBookmark', serialized);
    }

}
