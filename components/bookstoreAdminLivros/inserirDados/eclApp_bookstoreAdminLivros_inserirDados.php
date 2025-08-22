<?php

class eclApp_bookstoreAdminLivros_inserirDados extends eclApp
{
    public static $name = 'inserir_dados';
    public static $content = 'bookstoreAdminLivros_inserirDados_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_inserirDados_main';
    }

}
