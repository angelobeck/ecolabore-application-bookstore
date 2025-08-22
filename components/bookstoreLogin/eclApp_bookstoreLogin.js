
class eclApp_bookstoreLogin extends eclApp {

    static name = '-login';
    static map = [];
    static content = 'bookstoreLogin_main';

    static dispatch() {
        page.modules.layout = 'bookstoreLogin_main';
    }

}
