<?php

class eclApp_bookstoreEstante extends eclApp
{
    public static $name = 'estante';
    public static $map = ['bookstoreLogin', 'bookstorePerfil'];
    public static $content = 'bookstoreEstante_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreEstante_main';
    }
}
