<?php

class eclApp_bookstoreAdminLivros_generosTodos extends eclApp
{
    public static $name = 'generos';
    public static $content = 'bookstoreAdminLivros_generosTodos_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminLivros_generosTodos_main';
    }

}
