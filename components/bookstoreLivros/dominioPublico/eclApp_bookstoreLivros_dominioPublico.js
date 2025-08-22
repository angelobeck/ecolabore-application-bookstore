
class eclApp_bookstoreLivros_dominioPublico extends eclApp {
    static name = '-dominio-publico';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_dominioPublico_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_dominioPublico_main';
    }
}
