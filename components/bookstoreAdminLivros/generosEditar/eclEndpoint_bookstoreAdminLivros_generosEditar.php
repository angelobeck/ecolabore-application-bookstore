<?php

class eclEndpoint_bookstoreAdminLivros_generosEditar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
        $parentName = $this->page->application->parent->parent->name;
        if ($parentName == '-autores')
            $mode = eclStore_bookstore_book::MODE_AUTHOR;
        else if ($parentName == '-generos')
            $mode = eclStore_bookstore_book::MODE_GENRE;
        else
            $mode = eclStore_bookstore_book::MODE_NARRATOR;

        $where = [
            'name' => $name,
            'mode' => $mode
        ];

        $rows = $io->database->select($store->bookstore_book, $where, 1);

        if (!$rows)
            return $this->error();

        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminLivros_generosEditar_edit', $rows[0]);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;
            $io->database->update($store->bookstore_book, $data, $rows[0]);
            return $this->response($data);
        }

        return $this->response($rows[0]);
    }

}
