<?php

class eclApp_bookstoreAdminContent_cadastrar extends eclApp
{
    public static $name = '-novo';
    public static $content = 'bookstoreAdminContent_cadastrar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminContent_cadastrar_main';
    }

}
