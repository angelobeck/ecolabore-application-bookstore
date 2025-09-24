<?php

class eclApp_bookstoreAdminContent_detalhes extends eclApp
{
    public static $name = '-default';
    public static $map = ['bookstoreAdminContent_editar', 'bookstoreAdminContent_remover'];
    public static $content = 'bookstoreAdminContent_detalhes_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminContent_detalhes_main';
        $page->endpoints->file = 'bookstoreAdminLivros_detalhes_file';
    }

}
