
class eclApp_bookstorePerfil_remover extends eclApp {
    static name = '-remover';
    static content = 'bookstorePerfil_remover_main';

    static dispatch() {
        page.modules.content = 'bookstorePerfil_remover_main';
    }

}
