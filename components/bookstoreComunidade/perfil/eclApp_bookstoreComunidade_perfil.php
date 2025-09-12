<?php

class eclApp_bookstoreComunidade_perfil extends eclApp
{
    public static $name = '-default';
    public static $content = 'bookstoreComunidade_perfil_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreComunidade_perfil_main';
    }

}
