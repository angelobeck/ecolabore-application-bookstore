
class eclApp_bookstoreCadastro extends eclApp {
    static name = 'cadastrar';
    static content = 'bookstoreCadastro_main';

    static dispatch() {
        page.modules.layout = 'bookstoreCadastro_main';
    }

}
