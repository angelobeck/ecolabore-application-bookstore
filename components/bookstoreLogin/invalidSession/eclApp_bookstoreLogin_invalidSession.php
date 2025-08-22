<?php

class eclApp_bookstoreLogin_invalidSession extends eclApp
{
    public static $name = '-invalid-session';
    public static $map = [];
    public static $content = 'bookstoreLogin_invalidSession_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLogin_main';
    }

}
