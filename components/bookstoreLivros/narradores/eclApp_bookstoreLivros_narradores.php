<?php

class eclApp_bookstoreLivros_narradores extends eclApp
{
    public static $name = '-narradores';
    public static $map = ['bookstoreLivros_narradoresDetalhes'];
    public static $content = 'bookstoreLivros_narradores_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreLivros_narradores_main';
    }

}
