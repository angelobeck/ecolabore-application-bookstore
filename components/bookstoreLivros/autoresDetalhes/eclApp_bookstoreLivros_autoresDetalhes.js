
class eclApp_bookstoreLivros_autoresDetalhes extends eclApp {
    static name = '-default';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_autoresDetalhes_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_autoresDetalhes_main';
    }
}
