<?php

class eclApp_bookstoreLivros_autores extends eclApp
{
    public static $name = '-autores';
    public static $map = ['bookstoreLivros_autoresDetalhes'];
    public static $content = 'bookstoreLivros_autores_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_autores_main';
    }

}
