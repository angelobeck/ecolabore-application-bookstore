<?php

class eclApp_bookstoreAdminUsuarios extends eclApp
{
    public static $name = 'usuarios';
    public static $map = ['bookstoreAdminUsuarios_usuariosCadastrar', 'bookstoreAdminUsuarios_verificarLista', 'bookstoreAdminUsuarios_bloqueadosLista', 'bookstoreAdminUsuarios_usuariosTodos', 'bookstoreAdminUsuarios_gruposCadastrar', 'bookstoreAdminUsuarios_gruposTodos', 'bookstoreAdminUsuarios_detalhes'];
    public static $content = 'bookstoreAdminUsuarios_main';

    static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_main';
    }

}
