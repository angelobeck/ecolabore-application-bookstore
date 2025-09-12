<?php

class eclEndpoint_bookstoreLivros_seriesDetalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'collection_name' => $this->page->application->name
    ];
        $books = $io->database->select($store->bookstore_book, $where);

        return $this->response(['books' => $books, 'name' => $this->page->application->name]);
    }

}
