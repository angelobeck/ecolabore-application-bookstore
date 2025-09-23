<?php

class eclApp_bookstoreAdminLivros extends eclApp
{
    public static $name = 'livros';
    public static $map = ['bookstoreAdminLivros_livrosCadastrar', 'bookstoreAdminLivros_livrosTodos', 'bookstoreAdminLivros_generosTodos', 'bookstoreAdminLivros_detalhes'];
    public static $content = 'bookstoreAdminLivros_main';

        static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_main';
    }

}
