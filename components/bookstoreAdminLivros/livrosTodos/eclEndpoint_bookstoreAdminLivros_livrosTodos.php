<?php

class eclEndpoint_bookstoreAdminLivros_livrosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $books = $io->database->select($store->bookstore_book, ['mode' => eclStore_bookstore_book::MODE_BOOK]);
        return [
            'response' => [
                'children' => $books
            ]
        ];
    }

}
