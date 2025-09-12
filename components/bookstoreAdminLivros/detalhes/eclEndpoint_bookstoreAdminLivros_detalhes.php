<?php

class eclEndpoint_bookstoreAdminLivros_detalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->name;
        $error = ['error' => ['message' => "Usuário {$name} não encontrado"]];
        $rows = $io->database->select($store->bookstore_book, ['name' => $name], 1);
        if (!$rows)
            return $error;

        $files = [];
        $location = PATH_ROOT . 'livros/' . $name;
        if (is_dir($location)) {
            foreach (scandir($location) as $fileName) {
                if ($fileName[0] != '.')
                    $files[] = $fileName;
            }
        }

        return $this->response([
            'book' => $rows[0],
            'files' => $files
        ]);
    }

}
