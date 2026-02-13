<?php

class eclEndpoint_bookstoreLivros_recentes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'adult' => 0
        ];

        $recents = $io->database->select($store->bookstore_book, $where, 30, [], 'created', 'DESC');

        return $this->response(['children' => $recents]);
    }

}
