<?php

class eclApp_bookstoreAdminLivros_detalhes_registro extends eclApp
{
    public static $name = '-editar-registro';
    public static $content = 'bookstoreAdminLivros_detalhes_registro_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_detalhes_registro_main';
    }

}
