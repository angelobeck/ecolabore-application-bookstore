<?php

class eclEndpoint_bookstoreLivros_dominioPublico extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'public' => 1
        ];
        $books = $store->bookstore_book->search($where);
        return [
            'response' => [
                'children' => $books
            ]
        ];
    }

}
