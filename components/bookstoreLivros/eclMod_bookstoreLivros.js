
class eclMod_bookstoreLivros extends eclMod {
    response = '';
    raw = '';
    filterKeywords;
    status = 'Escreva uma palavra no campo acima para pesquisar';

    connectedCallback() {
        this.track('response');
        this.track('status');
    }

    handleClick() {
        this.status = 'Pesquisando...';
        this.response = [];
        var keywords = this.filterKeywords.value;
        if (keywords.length < 3) {
            this.status = 'O texto a pesquisar é muito curto, escreva uma palavra com pelo menos 3 letras.';
            return;
        }

        io.request({ keywords: keywords })
            .then((response, raw) => {
                this.raw = raw;
                if (!Array.isArray(response.children) || response.children.length === 0) {
                    this.status = 'Não encontrei nenhum livro. Você poderia fornecer uma palavra diferente?';
                    return;
                }
                var length = response.children.length;
                if (length === 1)
                    this.status = 'Encontrei 1 livro.';
                else if (length < 100)
                    this.status = 'Encontrei ' + length + ' livros.';
                else
                    this.status = 'Encontrei muitos livros. Vou listar os 100 primeiros que eu encontrei, mas sujiro que escolha uma palavra mais específica.';
                this.response = response.children;
            });
    }

    renderedCallback() {
        if (page.actions.keywords && page.actions.keywords.length > 1) {
            this.filterKeywords.value = page.actions.keywords[1].replace(/[+]/g, ' ');
            page.actions.keywords = [];
            this.handleClick();
        }
    }

    get _children_() {
        if (!Array.isArray(this.response))
            return [];

        var basePath = page.application.path;

        return this.response.map(child => {
            return {
                title: child.text.title,
                url: page.url([...basePath, child.name])
            }
        });
    }
}