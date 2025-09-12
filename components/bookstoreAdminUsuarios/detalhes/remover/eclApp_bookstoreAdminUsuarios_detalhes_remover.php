<?php

class eclApp_bookstoreAdminUsuarios_detalhes_remover extends eclApp
{
    public static $name = '-remover';
    public static $content = 'bookstoreAdminUsuarios_detalhes_remover_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_detalhes_remover_main';
    }

}
