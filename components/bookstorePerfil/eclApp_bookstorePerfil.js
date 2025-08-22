
class eclApp_bookstorePerfil extends eclApp {
    static name = 'perfil';
    static map = [];
    static content = 'bookstorePerfil_main';

    static dispatch(page) {
        page.modules.content = 'bookstorePerfil_main';
    }
}
