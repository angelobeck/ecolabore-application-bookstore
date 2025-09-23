<?php

class eclApp_bookstoreAdminLivros_generosEditar extends eclApp
{
    public static $name = '-editar-registro';
    public static $content = 'bookstoreAdminLivros_generosEditar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_generosEditar_main';
    }

}
