
class eclApp_bookstoreAdminLivros_livrosCadastrar extends eclApp {
    static name = '-novo-livro';
    static content = 'bookstoreAdminLivros_livrosCadastrar_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_livrosCadastrar_main';
    }

}
