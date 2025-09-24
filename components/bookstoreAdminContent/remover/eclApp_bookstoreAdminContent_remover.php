<?php

class eclApp_bookstoreAdminContent_remover extends eclApp
{
    public static $name = '-remover';
    public static $content = 'bookstoreAdminContent_remover_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminContent_remover_main';
    }

}
