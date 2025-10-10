<?php

class eclEndpoint_bookstoreLivro_audiobook extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
$book = $store->bookstore_book->open($name);
        $url = AWS_BUCKET . $name . '.mp3';
                return $this->response([
            'book' => $book,
            'url' => $url
    ]);
    }

}
