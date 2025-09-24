
class eclApp_bookstoreAdminContent extends eclApp
{
    static name = 'content';
    static map = ['bookstoreAdminContent_cadastrar', 'bookstoreAdminContent_detalhes'];
    static content = 'bookstoreAdminContent_main';

       static dispatch() {
        page.modules.content = 'bookstoreAdminContent_main';
    }

}
