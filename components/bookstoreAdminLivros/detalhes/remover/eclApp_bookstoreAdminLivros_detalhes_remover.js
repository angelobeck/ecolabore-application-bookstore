
class eclApp_bookstoreAdminLivros_detalhes_remover extends eclApp {
    static name = '-remover';
    static content = 'bookstoreAdminLivros_detalhes_remover_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_detalhes_remover_main';
    }

}
