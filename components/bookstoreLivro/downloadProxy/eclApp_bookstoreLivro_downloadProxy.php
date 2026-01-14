<?php

class eclApp_bookstoreLivro_downloadProxy extends eclApp
{
    public static $name = '-default';

    public static function dispatch(eclEngine_page $page): void
    {
        $name = $page->application->parent->parent->name;

        $book = $store->bookstore_book->open($name);
        if (!$book)
            $message = 'O livro ' . $name . ' não foi encontrado.';
        else if (!$book['format_audio'])
            $message = 'Este livro não está disponível em áudio.';
        else
            $message = eclEndpoint_bookstoreLivro::bookRestrictions($this->page, $book, 'audio');
        if (strlen($message)) {
            print $message;
            exit();
        }

        $location = AWS_BUCKET . $name . '.mp3';
        eclIo_sendFile::send($location, []);
        exit();

    }

}
