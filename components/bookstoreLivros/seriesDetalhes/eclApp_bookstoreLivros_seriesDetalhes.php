<?php

class eclApp_bookstoreLivros_seriesDetalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_seriesDetalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_seriesDetalhes_main';
    }

}
