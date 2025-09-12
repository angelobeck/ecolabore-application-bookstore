
class eclApp_bookstoreLivros_series extends eclApp {
    static name = '-series';
    static map = ['bookstoreLivros_seriesDetalhes'];
    static content = 'bookstoreLivros_series_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_series_main';
    }
}
