<?php

class eclApp_bookstoreAdminUsuarios_verificar extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreAdminUsuarios_verificar_inlineImage'];
    public static $content = 'bookstoreAdminUsuarios_verificar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_verificar_main';
    }

}
