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
        $location = PATH_ROOT . 'livros/' . $name . '/';
        if (is_dir($location)) {
            if (
                isset($input['action'])
                and $input['action'] == 'remove_file'
                and isset($input['filename'])
                and preg_match('/^[a-zA-Z0-9_-]+[.][a-z0-9]+$/', $input['filename'])
                and is_file($location . $input['filename'])
            )
                unlink($location . $input['filename']);

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
