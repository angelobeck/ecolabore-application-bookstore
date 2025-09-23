<?php

class eclApp_bookstoreAdminLivros_generosRemover extends eclApp
{
    public static $name = '-remover';
    public static $content = 'bookstoreAdminLivros_generosRemover_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_generosRemover_main';
    }

}
