
class eclApp_bookstoreAdminUsuarios extends eclApp {
    static name = 'usuarios';
    static map = ['bookstoreAdminUsuarios_usuariosCadastrar', 'bookstoreAdminUsuarios_verificarLista', 'bookstoreAdminUsuarios_usuariosTodos', 'bookstoreAdminUsuarios_gruposCadastrar', 'bookstoreAdminUsuarios_gruposTodos', 'bookstoreAdminUsuarios_detalhes'];
    static content = 'bookstoreAdminUsuarios_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminUsuarios_main';
    }

}
