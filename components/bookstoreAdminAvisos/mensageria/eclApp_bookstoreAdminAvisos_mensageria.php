<?php

class eclApp_bookstoreAdminAvisos_mensageria extends eclApp
{
    public static $name = 'mensageria';
    public static $content = 'bookstoreAdminAvisos_mensageria_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->endpoints->main = 'bookstoreAdminAvisos_mensageria_main';
    }

}
