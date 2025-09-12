<?php

class eclApp_bookstoreAcets_download extends eclApp
{
        public static $name = '-default';

    public static function dispatch(eclEngine_page $page): void
    {
        $file = $page->application->name;
        $location = PATH_ROOT . 'acets/' . $file;

        if (is_file($location)) {
            eclIo_sendFile::send($location, ['Content-Disposition' => 'inline']);
            exit();
        }
    }

}
