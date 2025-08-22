
class eclApp_bookstoreLivro_download extends eclApp {

    static name = 'download';
    static content = 'bookstoreLivro_download_main';

    static dispatch() {
        page.modules.content = 'bookstoreLivro_download_main';
    }

}
