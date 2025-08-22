
class eclApp_bookstoreAdminLivros_livrosTodos extends eclApp {
    static name = 'livros';
    static map = ['bookstoreAdminLivros_livrosDetalhes'];
    static content = 'bookstoreAdminLivros_livrosTodos_main';

    static dispatch() {
page.modules.content = 'bookstoreAdminLivros_livrosTodos_main';
    }
}
