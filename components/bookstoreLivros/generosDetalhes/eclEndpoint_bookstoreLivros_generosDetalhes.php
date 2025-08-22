<?php

class eclEndpoint_bookstoreLivros_generosDetalhes extends eclEndpoint
{

    public function dispatch(array $input): array
            {
        global $store;

    $where = [
            'mode' => eclStore_bookstore_book::MODE_GENRE,
            'name' => $this->page->application->name
    ];
        $genre = $store->bookstore_book->search($where);
        
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'genre_name' => $this->page->application->name
    ];
        $books = $store->bookstore_book->search($where);

        return [
            'response' => [
                'children' => $books,
                'genre' => $genre[0] ?? []
            ]
        ];
    }

}
