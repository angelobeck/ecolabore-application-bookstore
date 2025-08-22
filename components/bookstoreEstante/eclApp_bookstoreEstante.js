
class eclApp_bookstoreEstante extends eclApp {
    static name = 'estante';
    static map = ['bookstoreLogin', 'bookstorePerfil'];
    static content = 'bookstoreEstante_main';

    static dispatch(page) {
        page.modules.content = 'bookstoreEstante_main';
    }
}
