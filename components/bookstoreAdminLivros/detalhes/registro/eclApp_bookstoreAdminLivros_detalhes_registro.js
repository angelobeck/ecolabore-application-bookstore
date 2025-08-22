
class eclApp_bookstoreAdminLivros_detalhes_registro extends eclApp {
    static name = '-editar-registro';
    static content = 'bookstoreAdminLivros_detalhes_registro_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_detalhes_registro_main';
    }

}
