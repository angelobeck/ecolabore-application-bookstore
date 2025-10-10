<?php

class eclApp_bookstorePerfil_remover extends eclApp
{
    public static $name = '-remover';
    public static $content = 'bookstorePerfil_remover_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstorePerfil_remover_main';
    }

}
