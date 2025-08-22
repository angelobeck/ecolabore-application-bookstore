<?php

class eclApp_bookstoreAdminLivros_livrosCadastrar extends eclApp
{
    public static $name = '-novo-livro';
    public static $content = 'bookstoreAdminLivros_livrosCadastrar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_livrosCadastrar_main';
    }

}
