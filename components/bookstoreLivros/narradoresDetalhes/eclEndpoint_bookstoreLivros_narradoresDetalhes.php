<?php

class eclEndpoint_bookstoreLivros_narradoresDetalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'narrator_name' => $this->page->application->name
    ];
        $books = $store->bookstore_book->search($where);

                $where = [
            'mode' => eclStore_bookstore_book::MODE_NARRATOR,
            'name' => $this->page->application->name
    ];
        $narrators = $store->bookstore_book->search($where);

        return [
            'response' => [
                'children' => $books,
                'narrator' => $narrators[0] ?? []
            ]
        ];
    }

}
