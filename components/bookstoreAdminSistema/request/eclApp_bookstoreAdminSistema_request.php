<?php

class eclApp_bookstoreAdminSistema_request extends eclApp
{
    public static $name = 'request';
    public static $content = 'bookstoreAdminSistema_request_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminSistema_request_main';
    }

}
