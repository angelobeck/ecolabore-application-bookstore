<?php

class eclApp_bookstoreLivros_narradoresDetalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_narradoresDetalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_narradoresDetalhes_main';
    }

}
