<?php

class eclApp_bookstoreAdminUsuarios_usuariosTodos extends eclApp
{
    public static $name = '-todos';
    public static $map = ['bookstoreAdminUsuarios_detalhes'];
    public static $content = 'bookstoreAdminUsuarios_usuariosTodos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_usuariosTodos_main';
    }

}
