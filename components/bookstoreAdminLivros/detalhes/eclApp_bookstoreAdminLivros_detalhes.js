
class eclApp_bookstoreAdminLivros_detalhes extends eclApp {

    static name = '-default';
    static map = ['bookstoreAdminLivros_detalhes_registro', 'bookstoreAdminLivros_detalhes_remover'];
    static content = 'bookstoreAdminLivros_detalhes_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_detalhes_main';
    }

}
