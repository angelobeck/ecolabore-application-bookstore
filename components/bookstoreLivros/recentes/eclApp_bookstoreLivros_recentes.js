
class eclApp_bookstoreLivros_recentes extends eclApp {
    static name = '-recentes';
    static map = ['bookstoreLivro'];
    static content = 'bookstoreLivros_recentes_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_recentes_main';
    }
}
