
class eclApp_bookstoreLivros_titulos extends eclApp {
    static name = '-titulos';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_titulos_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_titulos_main';
    }
}
