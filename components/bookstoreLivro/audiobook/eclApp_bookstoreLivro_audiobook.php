<?php

class eclApp_bookstoreLivro_audiobook extends eclApp
{
    public static $name = 'audiobook';
    public static $content = 'bookstoreLivro_audiobook_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivro_audiobook_main';
    }

}
