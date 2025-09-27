
class eclApp_bookstoreContent extends eclApp {

    static isChild(parent, name) {
        var data = store.load('bookstore_content').open(name);
        return !!data;
    }

    static childrenNames(parent) {
        return [];
    }

    static constructorHelper(me) {
        me.data = store.load('bookstore_content').open(me.name);
    }

}
