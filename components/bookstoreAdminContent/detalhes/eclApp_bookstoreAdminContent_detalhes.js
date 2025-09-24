
class eclApp_bookstoreAdminContent_detalhes extends eclApp {

    static name = '-default';
    static map = ['bookstoreAdminContent_editar', 'bookstoreAdminContent_remover'];
    static content = 'bookstoreAdminContent_detalhes_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminContent_detalhes_main';
    }

}
