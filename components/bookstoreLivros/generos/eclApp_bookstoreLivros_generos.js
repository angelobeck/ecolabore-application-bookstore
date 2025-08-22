
class eclApp_bookstoreLivros_generos extends eclApp {
    static name = '-generos';
    static map = ['bookstoreLivros_generosDetalhes'];
    static content = 'bookstoreLivros_generos_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_generos_main';
    }
}
