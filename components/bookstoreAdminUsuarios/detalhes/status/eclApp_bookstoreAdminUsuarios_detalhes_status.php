<?php

class eclApp_bookstoreAdminUsuarios_detalhes_status extends eclApp
{
    public static $name = 'status';
    public static $content = 'bookstoreAdminUsuarios_detalhes_status_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_detalhes_status_main';
        $page->endpoints->file = 'bookstoreAdminUsuarios_detalhes_status_file';
    }

}
