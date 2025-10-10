
class eclApp_bookstorePerfil extends eclApp {
    static name = 'perfil';
    static map = ['bookstorePerfil_public', 'bookstorePerfil_personal', 'bookstorePerfil_password', 'bookstorePerfil_remover'];
    static content = 'bookstorePerfil_main';
    static access = 1;

    static dispatch(page) {
        page.modules.content = 'bookstorePerfil_main';
    }
}
