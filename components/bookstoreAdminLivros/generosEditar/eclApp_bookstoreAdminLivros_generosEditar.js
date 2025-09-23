
class eclApp_bookstoreAdminLivros_generosEditar extends eclApp {
    static name = '-editar-registro';
    static content = 'bookstoreAdminLivros_generosEditar_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_generosEditar_main';
    }

}
