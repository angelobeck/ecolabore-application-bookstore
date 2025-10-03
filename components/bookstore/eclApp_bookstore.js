
class eclApp_bookstore extends eclApp {
    static name = 'bookstore';
    static content = 'bookstore_main';

        static constructorHelper(me) {
        me.map =[...getMap('bookstore'), 'bookstoreHome', 'bookstoreLivros', 'bookstoreEstante', 'bookstoreComunidade', 'bookstoreAdmin', 'bookstoreCadastro', 'bookstoreLogin', 'bookstoreLogin_accessDenied', 'bookstoreLogin_invalidSession', 'bookstoreContent', 'bookstoreNotFound'];
    }

    static dispatch(page) {
        page.modules.content = 'bookstore_modContent_main';
        page.modules.dialog = 'bookstore_modDialog_main';
        page.modules.layout = 'bookstore_modLayout_main';
        page.modules.levelUp = 'bookstore_modLevelUp_main';
        page.modules.list = 'bookstore_modList_main';
        page.modules.nav = 'bookstore_modNav_main';
        page.modules.title = 'bookstore_modTitle_main';
        page.modules.user = 'bookstore_modUser_main';
    }
}
