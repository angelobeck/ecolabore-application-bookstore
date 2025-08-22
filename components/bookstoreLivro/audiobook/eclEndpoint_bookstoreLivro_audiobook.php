<?php

class eclEndpoint_bookstoreLivro_audiobook extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
        $error = ['error' => ['message' => "Usuário {$name} não encontrado"]];
        $rows = $io->database->select($store->bookstore_book, ['name' => $name], 1);
        if (!$rows)
            return $error;
        return [
            'response' => $rows[0]
        ];
    }

}
