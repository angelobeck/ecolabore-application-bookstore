<?php

class eclApp_bookstoreLivros_dominioPublico extends eclApp
{
    public static $name = '-dominio-publico';
    public static $map = ['bookstoreLivro'];
    public static $content = 'bookstoreLivros_dominioPublico_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_dominioPublico_main';
    }

}
