<?php

class eclApp_bookstoreLivro_downloadFile extends eclApp
{
    public static $name = '-default';

    public static function dispatch(eclEngine_page $page): void
    {
        $folder = $page->application->parent->parent->name;
        $file = $page->application->name;
        $location = PATH_ROOT . 'livros/' . $folder . '/' . $file;

        if (is_file($location)) {
            eclIo_sendFile::send($location, []);
            exit();
        }
    }

}
