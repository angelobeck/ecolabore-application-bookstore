
class eclApp_bookstoreLivros_seriesDetalhes extends eclApp {
    static name = '-default';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_seriesDetalhes_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_seriesDetalhes_main';
    }
}
