
class eclApp_bookstoreComunidade_usuariosTodos extends eclApp {
    static name = '-todos';
    static map = ['bookstoreComunidade_perfil'];
    static content = 'bookstoreComunidade_usuariosTodos_main';

    static dispatch() {
page.modules.list = 'bookstoreComunidade_usuariosTodos_main';
    }
}
