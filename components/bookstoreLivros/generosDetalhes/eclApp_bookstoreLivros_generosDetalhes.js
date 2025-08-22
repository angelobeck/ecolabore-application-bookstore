
class eclApp_bookstoreLivros_generosDetalhes extends eclApp {
    static name = '-default';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_generosDetalhes_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_generosDetalhes_main';
    }
}
