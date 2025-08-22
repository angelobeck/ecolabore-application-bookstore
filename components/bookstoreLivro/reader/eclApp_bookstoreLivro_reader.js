
class eclApp_bookstoreLivro_reader extends eclApp {

    static name = 'reader';
    static content = 'bookstoreLivro_reader_main';

    static dispatch() {
        page.modules.content = 'bookstoreLivro_reader_main';
    }

}
