<?php

class eclApp_bookstoreLivros_series extends eclApp
{
    public static $name = '-series';
    public static $map = ['bookstoreLivros_seriesDetalhes'];
    public static $content = 'bookstoreLivros_series_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_series_main';
    }

}
