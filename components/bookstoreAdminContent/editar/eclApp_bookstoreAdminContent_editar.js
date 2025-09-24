
class eclApp_bookstoreAdminContent_editar extends eclApp {
    static name = '-editar-pagina';
    static content = 'bookstoreAdminContent_editar_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminContent_editar_main';
    }

}
