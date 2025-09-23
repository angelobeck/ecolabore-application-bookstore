
class eclApp_bookstoreAdminLivros_generosRemover extends eclApp {
    static name = '-remover';
    static content = 'bookstoreAdminLivros_generosRemover_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_generosRemover_main';
    }

}
