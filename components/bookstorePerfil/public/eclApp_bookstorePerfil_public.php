<?php

class eclApp_bookstorePerfil_public extends eclApp
{
    public static $name = 'public';
    public static $content = 'bookstorePerfil_public_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_public_main';
    }

}
