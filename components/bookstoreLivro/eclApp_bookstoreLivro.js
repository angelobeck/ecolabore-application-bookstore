
class eclApp_bookstoreLivro extends eclApp {

    static name = '-default';
    static map = ['bookstoreLivro_audiobook', 'bookstoreLivro_download', 'bookstoreLivro_reader'];
    static content = 'bookstoreLivro_main';

    static dispatch() {
        page.modules.content = 'bookstoreLivro_main';
    }

}
