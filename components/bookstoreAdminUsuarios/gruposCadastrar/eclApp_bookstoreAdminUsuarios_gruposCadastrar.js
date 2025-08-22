
class eclApp_bookstoreAdminUsuarios_gruposCadastrar extends eclApp {
    static name = '-cadastrar-novo-grupo';
    static content = 'bookstoreAdminUsuarios_gruposCadastrar_main';

    static dispatch() {
page.modules.content = page.createModule('bookstoreAdminUsuarios_gruposCadastrar_main');
    }
}
