
class eclApp_bookstoreLogin_invalidSession extends eclApp {

    static name = '-invalid-session';
    static map = [];
    static content = 'bookstoreLogin_invalidSession_main';

    static dispatch() {
        page.modules.layout = 'bookstoreLogin_invalidSession_main';
    }

}
