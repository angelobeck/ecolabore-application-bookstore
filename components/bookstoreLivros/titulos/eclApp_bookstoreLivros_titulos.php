<?php

class eclApp_bookstoreLivros_titulos extends eclApp
{
    public static $name = '-titulos';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_titulos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_titulos_main';
    }

}
