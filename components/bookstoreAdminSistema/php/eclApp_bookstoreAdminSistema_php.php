<?php

class eclApp_bookstoreAdminSistema_php extends eclApp
{
    public static $name = 'php';
    public static $content = 'bookstoreAdminSistema_php_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminSistema_php_main';
    }

}
