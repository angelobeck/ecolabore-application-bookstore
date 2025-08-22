<?php

class eclApp_bookstoreAdminUsuarios_detalhes_password extends eclApp
{
    public static $name = 'password';
    public static $content = 'bookstoreAdminUsuarios_detalhes_password_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_detalhes_password_main';
    }

}
