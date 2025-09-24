<?php

class eclApp_bookstoreAdminContent extends eclApp
{
    public static $name = 'content';
    public static $map = ['bookstoreAdminContent_cadastrar', 'bookstoreAdminContent_detalhes'];
    public static $content = 'bookstoreAdminContent_main';

        static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminContent_main';
    }

}
