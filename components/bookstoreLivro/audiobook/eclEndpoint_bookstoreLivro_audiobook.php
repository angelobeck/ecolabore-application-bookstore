<?php

class eclEndpoint_bookstoreLivro_audiobook extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
$book = $store->bookstore_book->open($name);
       if(!$book)
            $message = 'O livro ' . $name . ' não foi encontrado.';
        else
        $message = eclEndpoint_bookstoreLivro::bookRestrictions($this->page, $book, 'audio');
        if(strlen($message))
            return $this->error(['message' => $message]);

        $url = AWS_BUCKET . $name . '.mp3';
                return $this->response([
            'book' => $book,
            'url' => $url
    ]);
    }

}
