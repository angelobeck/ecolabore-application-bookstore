<?php

class eclApp_bookstorePerfil_password extends eclApp
{
    public static $name = 'password';
    public static $content = 'bookstorePerfil_password_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_password_main';
    }

}
