
class eclApp_bookstoreAdminUsuarios_gruposTodos extends eclApp {
    static name = '-todos-os-grupos';
    static content = 'bookstoreAdminUsuarios_gruposTodos_main';

    static dispatch() {
page.modules.content = page.createModule('bookstoreAdminUsuarios_gruposTodos_main');
    }
}
