
class eclMod_bookstore_modNav extends eclMod {

    get _children_() {
        this.children = [];
        var children = page.domain.children();
        for (let i = 0; i < children.length; i++) {
            let child = children[i];
            if(!page.access(child.access, child.groups))
                continue;
            if (child.data.flags && child.data.flags.modNav_show) {
                this.appendChild(child.data)
                    .current(child.path === page.application.path ? 'page' : 'false')
                    .url(child.path);
            }
        }
        return this.children;
    }

}
