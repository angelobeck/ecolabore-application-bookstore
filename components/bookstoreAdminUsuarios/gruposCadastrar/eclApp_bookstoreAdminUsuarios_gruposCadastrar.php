<?php

class eclApp_bookstoreAdminUsuarios_gruposCadastrar extends eclApp
{
    public static $name = '-cadastrar-novo-grupo';
    public static $content = 'bookstoreAdminUsuarios_gruposCadastrar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_gruposCadastrar_main';
    }

}
