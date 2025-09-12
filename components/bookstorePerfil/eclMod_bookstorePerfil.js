
class eclMod_bookstorePerfil extends eclMod {
    user = {};
    userContent = {};

    connectedCallback() {
        this.track('user');
        this.update();
    }

    update() {
        io.request()
            .then((response) => {
                this.user = response.user;
                this.userContent = response.userContent;
            });
    }

    get _paragraphs_() {
        var paragraphs = [];
        this.userContent.text.content.pt.value.split("\n").map(line => {
            if (line != '')
                paragraphs.push(line);
        });
        return paragraphs;
    }

}