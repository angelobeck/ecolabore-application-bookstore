<?php

class eclApp_bookstoreLivros_generos extends eclApp
{
    public static $name = '-generos';
    public static $map = ['bookstoreLivros_generosDetalhes'];
    public static $content = 'bookstoreLivros_generos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_generos_main';
    }

}
