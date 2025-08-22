
class eclApp_bookstoreLivros_narradores extends eclApp {
    static name = '-narradores';
    static map = ['bookstoreLivros_narradoresDetalhes'];
    static content = 'bookstoreLivros_narradores_main';

    static dispatch() {
page.modules.content = 'bookstoreLivros_narradores_main';
    }
}
