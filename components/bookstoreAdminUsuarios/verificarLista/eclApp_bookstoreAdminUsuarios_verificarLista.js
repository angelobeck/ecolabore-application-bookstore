
class eclApp_bookstoreAdminUsuarios_verificarLista extends eclApp {
    static name = '-verificar';
    static map = ['bookstoreAdminUsuarios_verificar'];
    static content = 'bookstoreAdminUsuarios_verificarLista_main';

    static dispatch() {
page.modules.list = 'bookstoreAdminUsuarios_verificarLista_main';
    }
}
