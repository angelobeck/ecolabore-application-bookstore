
class eclMod_bookstoreLivro_reader extends eclMod {
    name = '';
    content = '';
    errorMessage = false;
    currentParagraph = 0;
    paragraphs;

    connectedCallback() {
        this.track('content');
        this.track('errorMessage');
        this.track('currentParagraph');
    }

    refreshCallback() {
        this.content = '';
        this.errorMessage = false;

        io.request(false, 'main', page.application.path)
            .then((response, raw) => {
                this.content = response.content;
            })
            .catch(error => {
                let message = store.staticContent.open(error.message);
                if (message)
                    this.errorMessage = message;
            });
    }

    get _paragraphs_() {
        return this.content.split("\n");
    }

    get _currentParagraph_() {
        return this.currentParagraph  ? "Marcador ajustado para o parágrafo " + this.currentParagraph : "O marcador não foi definido.";
    }

    handleContextmenu(event) {
        event.preventDefault();
        event.stopPropagation();
        var paragraph = event.currentTarget;
        var parent = paragraph.parentElement;
        var index = 0;
        while (index < parent.children.length && parent.children[index] !== paragraph) {
            index++;
        }
        this.currentParagraph = index;
    }

    handleKeydown() {
        if (event.altKey || event.ctrlKey || event.metaKey)
            return;
        if (event.key === "Enter")
            handleContextmenu(event);
    }

    actionGotoMarker() {
        if (this.paragraphs && this.paragraphs.children && this.paragraphs.children[this.currentParagraph]) {
            this.paragraphs.children[this.currentParagraph].setAttribute('tabindex', '0');
            this.paragraphs.children[this.currentParagraph].focus();
        }
    }
}
