
class eclApp_bookstoreLogin_accessDenied extends eclApp {

    static name = '-access-denied';
    static map = [];
    static content = 'bookstoreLogin_accessDenied_main';

    static dispatch() {
        page.modules.layout = 'bookstoreLogin_accessDenied_main';
    }

}
