
class eclApp_bookstoreLivro_audiobook extends eclApp {

    static name = 'audiobook';
    static content = 'bookstoreLivro_audiobook_main';

    static dispatch() {
        page.modules.content = 'bookstoreLivro_audiobook_main';
    }

}
