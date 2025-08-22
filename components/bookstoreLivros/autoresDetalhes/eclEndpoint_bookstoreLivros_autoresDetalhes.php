<?php

class eclEndpoint_bookstoreLivros_autoresDetalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'author_name' => $this->page->application->name
    ];
        $books = $store->bookstore_book->search($where);

                $where = [
            'mode' => eclStore_bookstore_book::MODE_AUTHOR,
            'name' => $this->page->application->name
    ];
        $author = $store->bookstore_book->search($where);
        
        return [
            'response' => [
                'children' => $books,
                'author' => $author[0] ?? []
            ]
        ];
    }

}
