<?php

class eclApp_bookstoreAdminLivros_generosCadastrar extends eclApp
{
    public static $name = 'novo_genero';
    public static $content = 'bookstoreAdminLivros_generosCadastrar_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_generosCadastrar_main';
    }

}
