<?php

class eclEndpoint_bookstoreAdminLivros_generosDetalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->name;
        $parentName = $this->page->application->parent->name;
        switch ($parentName) {
            case '-autores':
                $mode = eclStore_bookstore_book::MODE_AUTHOR;
                break;

            case '-generos':
                $mode = eclStore_bookstore_book::MODE_GENRE;
                break;

            case '-narradores':
                $mode = eclStore_bookstore_book::MODE_NARRATOR;
        }

        ecl_log($parentName . ' ' . $name);
        $where = [
            'mode' => $mode,
            'name' => $name
        ];

        $rows = $io->database->select($store->bookstore_book, $where, 1);
        if (!$rows)
            return $this->error();

        $where = ['mode' => eclStore_bookstore_book::MODE_BOOK];

        switch ($parentName) {
            case '-autores':
                $where['author_name'] = $name;
                break;

            case '-generos':
                $where['genre_name'] = $name;
                break;

            case '-narradores':
                $where['narrator_name'] = $name;
        }

        $books = $io->database->select($store->bookstore_book, $where);

        return $this->response([
            'register' => $rows[0],
            'books' => $books
        ]);
    }

}
