
class eclApp_bookstoreLivros extends eclApp {
    static name = 'livros';
    static map = ['bookstoreLivros_generos', 'bookstoreLivros_autores', 'bookstoreLivros_titulos', 'bookstoreLivros_narradores', 'bookstoreLivros_dominioPublico', 'bookstoreLivros_series', 'bookstoreLivro'];
    static content = 'bookstoreLivros_main';

    static dispatch() {
        page.modules.content = 'bookstoreLivros_main';
    }
}