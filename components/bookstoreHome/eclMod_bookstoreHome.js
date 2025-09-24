
class eclMod_bookstoreHome extends eclMod {
    url;
    sections = [];

    connectedCallback() {
        this.track('sections');
        this.url = page.url([page.domain.name, 'livros', '-dominio-publico']);

        io.request()
            .then(response => {
                this.sections = response.children;
                store.bookstore_content = response.children;
            });
    }

    get _sections_() {
        var sections = [];

        if (!store.bookstore_content)
            return [];

        for (let i = 0; i < store.bookstore_content.length; i++) {
            const section = store.bookstore_content[i];
                sections.push(section);
        }

        return sections.map(section => {
            return {
                title: section.text.title,
                url: page.url([page.domain.name, section.name])
            };
        });
    }

}
