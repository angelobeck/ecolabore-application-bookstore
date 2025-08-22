<?php

class eclEndpoint_bookstoreAdminLivros_generosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $books = $store->bookstore_book->search(['mode' => eclStore_bookstore_book::MODE_GENRE]);
        return [
            'response' => [
                'children' => $books
            ]
        ];
    }

}
