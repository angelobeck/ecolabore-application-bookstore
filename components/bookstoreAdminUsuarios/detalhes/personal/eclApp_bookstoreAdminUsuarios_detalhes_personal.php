<?php

class eclApp_bookstoreAdminUsuarios_detalhes_personal extends eclApp
{
    public static $name = 'personal';
    public static $content = 'bookstoreAdminUsuarios_detalhes_personal_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_detalhes_personal_main';
    }

}
