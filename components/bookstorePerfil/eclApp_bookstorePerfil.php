<?php

class eclApp_bookstorePerfil extends eclApp
{
    public static $name = 'perfil';
    public static $map = [];
    public static $content = 'bookstorePerfil_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_main';
    }
}
