<?php

class eclApp_bookstoreAdminLivros_detalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreAdminLivros_detalhes_registro', 'bookstoreAdminLivros_detalhes_remover'];
    public static $content = 'bookstoreAdminLivros_detalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_detalhes_main';
        $page->endpoints->file = 'bookstoreAdminLivros_detalhes_file';
    }

}
