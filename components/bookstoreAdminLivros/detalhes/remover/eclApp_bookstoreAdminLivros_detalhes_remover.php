<?php

class eclApp_bookstoreAdminLivros_detalhes_remover extends eclApp
{
    public static $name = '-remover';
    public static $content = 'bookstoreAdminLivros_detalhes_remover_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_detalhes_remover_main';
    }

}
