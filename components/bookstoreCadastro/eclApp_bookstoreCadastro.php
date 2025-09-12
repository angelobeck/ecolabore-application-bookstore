<?php

class eclApp_bookstoreCadastro extends eclApp
{
    public static $name = 'cadastrar';
    public static $content = 'bookstoreCadastro_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreCadastro_main';
        $page->endpoints->file = 'bookstoreCadastro_file';
    }

}
