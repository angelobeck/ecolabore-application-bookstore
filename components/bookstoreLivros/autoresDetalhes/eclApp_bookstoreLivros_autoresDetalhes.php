<?php

class eclApp_bookstoreLivros_autoresDetalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_autoresDetalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_autoresDetalhes_main';
    }

}
