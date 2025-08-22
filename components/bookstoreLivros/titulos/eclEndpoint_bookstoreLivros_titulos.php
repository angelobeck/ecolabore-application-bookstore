<?php

class eclEndpoint_bookstoreLivros_titulos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $books = $store->bookstore_book->search(['mode' => eclStore_bookstore_book::MODE_BOOK]);
        return [
            'response' => [
                'children' => $books
            ]
        ];
    }

}
