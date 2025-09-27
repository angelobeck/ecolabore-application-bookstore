
class eclStore_bookstore_content {
    cache = [];
    loading = false;


    constructor() {
        var serialized = window.localStorage.getItem('bookstore_content');
        if (serialized) {
            this.cache = unserialize(serialized);
        } else {
            page.blocked = true;
            var url = page.url([page.domain.name]);
            io.request(false, 'main', url)
                .then(response => {
                    this.cache = response.children;
                    localStorage.setItem('bookstore_content', serialize(this.cache));
                    page.blocked = false;
                    page.rootNode.refresh();
                })
                .catch(error => {
                    page.blocked = false;
                    page.rootNode.refresh();
                });
        }

    }

    update(children) {
        this.cache = children;
        localStorage.setItem('bookstore_content', serialize(this.cache));
    }

    open(name) {
        for (let i = 0; i < this.cache.length; i++) {
            if (this.cache[i].name === name)
                return this.cache[i];
        }
        return {};
    }

    children(parentId) {
        var children = [];
        for (let i = 0; i < this.cache.length; i++) {
            if (this.cache[i].parent_id === parentId)
                children.push(this.cache[i]);
        }

        children.sort((a, b) => {
            if (a.index === b.index)
                return 0;
            if (a.index > b.index)
                return 1;
            else
                return -1;
        });

        return children;
    }

}
