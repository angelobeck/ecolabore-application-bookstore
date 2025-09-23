<?php

class eclApp_bookstoreAdminLivros_generosDetalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreAdminLivros_generosEditar', 'bookstoreAdminLivros_generosRemover'];
    public static $content = 'bookstoreAdminLivros_generosDetalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_generosDetalhes_main';
        $page->endpoints->file = 'bookstoreAdminLivros_detalhes_file';
    }

}
