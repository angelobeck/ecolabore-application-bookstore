<?php

class eclApp_bookstoreComunidade_usuariosTodos extends eclApp
{
    public static $name = '-todos';
    public static $map = ['bookstoreComunidade_perfil'];
    public static $content = 'bookstoreComunidade_usuariosTodos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreComunidade_usuariosTodos_main';
    }

}
