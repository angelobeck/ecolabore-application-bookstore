<?php

class eclApp_bookstorePerfil_personal extends eclApp
{
    public static $name = 'personal';
    public static $content = 'bookstorePerfil_personal_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_personal_main';
    }

}
