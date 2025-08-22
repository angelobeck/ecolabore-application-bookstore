
class eclApp_bookstoreAdminUsuarios_usuariosTodos extends eclApp {
    static name = '-todos';
    static map = ['bookstoreAdminUsuarios_detalhes'];
    static content = 'bookstoreAdminUsuarios_usuariosTodos_main';

    static dispatch() {
page.modules.list = 'bookstoreAdminUsuarios_usuariosTodos_main';
    }
}
