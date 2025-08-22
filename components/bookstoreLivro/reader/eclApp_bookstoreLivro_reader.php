<?php

class eclApp_bookstoreLivro_reader extends eclApp
{
    public static $name = 'reader';
    public static $content = 'bookstoreLivro_reader_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivro_reader_main';
    }

}
