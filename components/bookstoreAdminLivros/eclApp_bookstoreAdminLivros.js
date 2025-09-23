
class eclApp_bookstoreAdminLivros extends eclApp
{
    static name = 'livros';
    static map = ['bookstoreAdminLivros_livrosCadastrar', 'bookstoreAdminLivros_livrosTodos', 'bookstoreAdminLivros_generosTodos', 'bookstoreAdminLivros_detalhes'];
    static content = 'bookstoreAdminLivros_main';

       static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_main';
    }

}
