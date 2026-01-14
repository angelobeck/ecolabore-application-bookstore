
class eclMod_bookstore_modNav extends eclMod {
    headerElement;

    get _children_() {
        this.children = [];

        if (SYSTEM_APP_ON)
            this.appendChild(store.staticContent.open('bookstore_modNav_back'))
                .url(page.application.parent.path)
                .disabled(page.application.path == page.domain.path)
                .role('button');

        var children = page.domain.children();
        for (let i = 0; i < children.length; i++) {
            let child = children[i];
            if (!page.access(child.access, child.groups))
                continue;
            if (child.data.flags && child.data.flags.modNav_show) {
                if (SYSTEM_APP_ON && child.path == page.domain.path)
                    continue;

                if (SYSTEM_APP_ON && child.path[1] == 'admin')
                    continue;

                this.appendChild(child.data)
                    .current(child.path === page.application.path ? 'page' : 'false')
                    .url(child.path)
                    .role('link');
            }
        }

        if (SYSTEM_APP_ON)
            this.appendChild(store.staticContent.open('bookstore_modNav_menu'))
                .url(page.application.path)
                .role('button');

        return this.children;
    }

    handleClick(event) {
        var url = event.currentTarget.dataset.url;

        if (url == page.url())
            this.menuOpen();
        else
            navigate(url);
    }

    handleKeydown(event) {
        if (event.altKey || event.ctrlKey || event.metaKey || event.shiftKey)
            return;
        if (event.key !== ' ' && event.key !== "Enter")
            return;

        this.handleClick(event);
    }

    menuOpen() {
        page.menuOpen('menu');
        setTimeout(() => {
            this.headerElement.focus();
        }, 90);
    }

    menuClose() {
        page.menuClose('menu');
    }

}
