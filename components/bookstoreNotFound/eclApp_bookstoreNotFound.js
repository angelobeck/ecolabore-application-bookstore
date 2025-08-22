
class eclApp_bookstoreNotFound extends eclApp {
    static name = '-not-found';
    static content = 'bookstoreNotFound_main';

    static constructorHelper(me) {
        me.ignoreSubfolders = true;
    }

}
