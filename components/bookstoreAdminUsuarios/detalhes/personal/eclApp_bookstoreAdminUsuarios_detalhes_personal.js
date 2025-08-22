
class eclApp_bookstoreAdminUsuarios_detalhes_personal extends eclApp {
    static name = 'personal';
    static content = 'bookstoreAdminUsuarios_detalhes_personal_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminUsuarios_detalhes_personal_main';
    }

}
