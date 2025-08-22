<?php

class eclEndpoint_bookstoreLivro_reader extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
        $error = ['error' => ['message' => "Livro {$name} não encontrado"]];
        $rows = $io->database->select($store->bookstore_book, ['name' => $name], 1);
        if (!$rows)
            return $error;
        $data = $rows[0];
        if (!isset($data['files']))
            return $error;
        $found = false;
        foreach ($data['files'] as $file) {
            $pos = strpos($file, '.txt');
            if ($pos) {
                $fileName = $file;
                $found = true;
                break;
            }
        }

        if (!$found)
            return $error;

        $location = PATH_ROOT . 'cache/livros/' . $fileName;
        if (!is_file($location))
            return $error;

        $buffer = mb_convert_encoding(file_get_contents($location), 'UTF-8', ['ISO-8859-1', 'UTF-8']);
        return [
            'response' => [
                'content' => $buffer
            ]
        ];

    }

}
