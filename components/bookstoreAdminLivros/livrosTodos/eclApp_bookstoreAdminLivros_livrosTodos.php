<?php

class eclApp_bookstoreAdminLivros_livrosTodos extends eclApp
{
    public static $name = 'livros';
    public static $map = ['bookstoreAdminLivros_livrosDetalhes'];
    public static $content = 'bookstoreAdminLivros_livrosTodos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_livrosTodos_main';
    }

}
