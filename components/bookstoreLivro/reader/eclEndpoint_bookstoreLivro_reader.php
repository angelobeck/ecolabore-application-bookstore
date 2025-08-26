<?php

class eclEndpoint_bookstoreLivro_reader extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;

        $location = PATH_ROOT . 'livros/' . $name . '/' . $name . '.txt';
        if (!is_file($location))
            return $this->response(['content' => 'O livro ' . $name . ' não foi encontrado.']);

        $content = file_get_contents($location);
        $content = mb_convert_encoding($content, 'UTF-8', 'ISO-8859-1');

        return $this->response(['content' => $content]);
    }

}
