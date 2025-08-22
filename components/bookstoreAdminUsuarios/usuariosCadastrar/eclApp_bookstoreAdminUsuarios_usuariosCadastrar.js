
class eclApp_bookstoreAdminUsuarios_usuariosCadastrar extends eclApp {
    static name = '-novo-usuario';
    static content = 'bookstoreAdminUsuarios_usuariosCadastrar_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminUsuarios_usuariosCadastrar_main';
    }

}
