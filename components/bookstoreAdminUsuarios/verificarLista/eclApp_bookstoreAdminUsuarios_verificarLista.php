<?php

class eclApp_bookstoreAdminUsuarios_verificarLista extends eclApp
{
    public static $name = '-verificar';
    public static $map = ['bookstoreAdminUsuarios_verificar'];
    public static $content = 'bookstoreAdminUsuarios_verificarLista_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_verificarLista_main';
    }

}
