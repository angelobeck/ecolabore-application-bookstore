<?php

class eclApp_bookstoreAdminUsuarios_semDocumentoLista extends eclApp
{
    public static $name = '-sem-documento';
    public static $content = 'bookstoreAdminUsuarios_semDocumentoLista_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminUsuarios_semDocumentoLista_main';
    }

}
