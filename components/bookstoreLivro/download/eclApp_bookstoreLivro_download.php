<?php

class eclApp_bookstoreLivro_download extends eclApp
{
    public static $name = 'download';
    public static $content = 'bookstoreLivro_download_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivro_download_main';
    }

}
