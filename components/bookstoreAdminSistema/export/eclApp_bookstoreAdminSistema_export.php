<?php

class eclApp_bookstoreAdminSistema_export extends eclApp
{
    public static $name = 'export';
    public static $content = 'bookstoreAdminSistema_export_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminSistema_export_main';
    }

}
