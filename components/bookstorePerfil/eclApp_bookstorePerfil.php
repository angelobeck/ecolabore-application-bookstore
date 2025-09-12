<?php

class eclApp_bookstorePerfil extends eclApp
{
    public static $name = 'perfil';
    public static $map = ['bookstorePerfil_public', 'bookstorePerfil_personal', 'bookstorePerfil_password'];
    public static $content = 'bookstorePerfil_main';
    public static $access = 1;

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_main';
        $page->endpoints->file = 'bookstorePerfil_file';
    }
}
