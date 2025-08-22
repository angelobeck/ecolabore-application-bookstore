<?php

class eclApp_bookstoreLivro extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreLivro_audiobook', 'bookstoreLivro_download', 'bookstoreLivro_reader'];
    public static $content = 'bookstoreLivro_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivro_main';
    }

}
