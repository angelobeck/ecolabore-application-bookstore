<?php

class eclApp_bookstoreAdminUsuarios_bloqueadosLista extends eclApp
{
    public static $name = '-bloqueados';
    public static $content = 'bookstoreAdminUsuarios_bloqueadosLista_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_bloqueadosLista_main';
    }

}
