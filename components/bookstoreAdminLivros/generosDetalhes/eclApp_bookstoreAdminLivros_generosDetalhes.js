
class eclApp_bookstoreAdminLivros_generosDetalhes extends eclApp {

    static name = '-default';
    static map = ['bookstoreAdminLivros_generosEditar', 'bookstoreAdminLivros_generosRemover'];
    static content = 'bookstoreAdminLivros_generosDetalhes_main';

    static dispatch() {
        page.modules.content = 'bookstoreAdminLivros_generosDetalhes_main';
    }

}
