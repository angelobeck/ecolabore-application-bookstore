<?php

class eclApp_bookstoreAdminContent_editar extends eclApp
{
    public static $name = '-editar-pagina';
    public static $content = 'bookstoreAdminContent_editar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminContent_editar_main';
    }

}
