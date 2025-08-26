<?php

class eclEndpoint_bookstoreLivro extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->name;
        $error = ['error' => ['message' => "Livro {$name} não encontrado"]];

        $where = [
            'name' => $name,
            'mode' => eclStore_bookstore_book::MODE_BOOK
        ];

        $rows = $io->database->select($store->bookstore_book, $where, 1);
        if (!$rows)
            return $error;

        $files = [];
        if (is_dir(PATH_ROOT . 'livros/' . $name)) {
            foreach (scandir(PATH_ROOT . 'livros/' . $name) as $file) {
                if ($file[0] == '.')
                    continue;

                $files[] = $file;
            }
        }

        return $this->response([
            'book' => $rows[0],
            'files' => $files
        ]);
    }

}
