
class eclApp_bookstoreHome extends eclApp {
    static name = '-home';
    static content = 'bookstoreHome_main';

    static constructorHelper(me) {
        me.path = me.parent.path;
    }

    static view_main(page) {
        page.modules.content = 'bookstoreHome_main';
    }

}
