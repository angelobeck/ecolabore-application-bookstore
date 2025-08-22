<?php

class eclApp_bookstoreLivros extends eclApp{
    static $name = 'livros';
    static $map = ['bookstoreLivros_generos', 'bookstoreLivros_autores', 'bookstoreLivros_titulos', 'bookstoreLivros_narradores', 'bookstoreLivros_dominioPublico', 'bookstoreLivro'];
    static $content = 'bookstoreLivros_main';

    static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_main';
    }
}