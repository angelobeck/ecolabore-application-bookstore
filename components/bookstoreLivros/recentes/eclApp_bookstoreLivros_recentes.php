<?php

class eclApp_bookstoreLivros_recentes extends eclApp
{
    public static $name = '-recentes';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_recentes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_recentes_main';
    }

}
