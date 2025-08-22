<?php

class eclApp_bookstoreAdminUsuarios_detalhes_public extends eclApp
{
    public static $name = 'public';
    public static $content = 'bookstoreAdminUsuarios_detalhes_public_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_detalhes_public_main';
    }

}
