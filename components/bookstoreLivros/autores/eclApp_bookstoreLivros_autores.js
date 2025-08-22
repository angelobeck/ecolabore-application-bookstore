
class eclApp_bookstoreLivros_autores extends eclApp {
    static name = '-autores';
    static map = ['bookstoreLivros_autoresDetalhes'];
    static content = 'bookstoreLivros_autores_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_autores_main';
    }
}
