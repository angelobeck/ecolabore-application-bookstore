<?php

class eclApp_bookstoreAdminUsuarios_gruposTodos extends eclApp
{
    public static $name = '-todos-os-grupos';
    public static $content = 'bookstoreAdminUsuarios_gruposTodos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_gruposTodos_main';
    }

}
