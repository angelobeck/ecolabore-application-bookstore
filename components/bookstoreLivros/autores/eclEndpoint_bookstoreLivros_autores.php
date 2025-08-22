<?php

class eclEndpoint_bookstoreLivros_autores extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $books = $store->bookstore_book->search(['mode' => eclStore_bookstore_book::MODE_AUTHOR]);
        return [
            'response' => [
                'children' => $books
            ]
        ];
    }

}
