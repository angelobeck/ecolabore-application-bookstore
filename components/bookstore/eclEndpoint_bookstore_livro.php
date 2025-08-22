<?php

class eclEndpoint_bookstore_livro extends eclEndpoint
{

    public function dispatch(array $where): array
    {
        global $io, $store;


        $rows = $store->bookstore_book->search($where);
        return [
            'response' => $rows
        ];
    }

}
