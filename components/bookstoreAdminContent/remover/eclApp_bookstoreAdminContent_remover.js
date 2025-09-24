
class eclApp_bookstoreAdminContent_remover extends eclApp {
    static name = '-remover';
    static content = 'bookstoreAdminContent_remover_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminContent_remover_main';
    }

}
