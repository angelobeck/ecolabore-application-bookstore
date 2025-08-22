<?php

class eclApp_bookstoreAdminUsuarios_usuariosCadastrar extends eclApp
{
    public static $name = '-novo-usuario';
    public static $content = 'bookstoreAdminUsuarios_usuariosCadastrar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_usuariosCadastrar_main';
    }

}
