<?php

class eclApp_bookstoreLivros_generosDetalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_generosDetalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_generosDetalhes_main';
    }

}
