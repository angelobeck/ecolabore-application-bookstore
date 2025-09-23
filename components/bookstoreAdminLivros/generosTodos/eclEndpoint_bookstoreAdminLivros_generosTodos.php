<?php

class eclEndpoint_bookstoreAdminLivros_generosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $name = $this->page->application->name;

        if ($name === '-autores')
            $mode = eclStore_bookstore_book::MODE_AUTHOR;
        else if ($name === '-generos')
            $mode = eclStore_bookstore_book::MODE_GENRE;
        else if ($name === '-narradores')
            $mode = eclStore_bookstore_book::MODE_NARRATOR;

        $books = $store->bookstore_book->search(['mode' => $mode]);
        return $this->response(['children' => $books]);
    }

}
