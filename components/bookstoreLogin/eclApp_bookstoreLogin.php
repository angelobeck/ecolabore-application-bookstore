<?php

class eclApp_bookstoreLogin extends eclApp
{
    public static $name = '-login';
    public static $map = [];
    public static $content = 'bookstoreLogin_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLogin_main';
    }

}
