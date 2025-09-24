<?php

class eclApp_bookstoreHome extends eclApp
{
    public static $name = '-home';
    public static $content = 'bookstoreHome_main';

    public static function constructorHelper(eclEngine_application $me): void
    {
        $me->path = $me->parent->path;
    }

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreHome_main';
    }
    public static function view_main(eclEngine_page $page): void
    {
        $page->modules->content = 'bookstoreHome_main';

        $about = $page->domain->child('sobre');
        $page->modules->list->appendChild($about)
        ->swapTitle()
        ->url($about->path);
    }
}
