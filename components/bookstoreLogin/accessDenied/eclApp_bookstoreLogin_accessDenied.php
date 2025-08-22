<?php

class eclApp_bookstoreLogin_accessDenied extends eclApp
{
    public static $name = '-access-denied';
    public static $map = [];
    public static $content = 'bookstoreLogin_accessDenied_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLogin_main';
    }

}
