
class eclApp_bookstorePerfil_personal extends eclApp {
    static name = 'personal';
    static content = 'bookstorePerfil_personal_main';

    static dispatch() {
        page.modules.content = 'bookstorePerfil_personal_main';
    }

}
