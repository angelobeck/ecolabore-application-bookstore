<?php

class eclEndpoint_bookstoreLivro_download extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;

        $book = $store->bookstore_book->open($name);
        if(!$book)
            $message = 'O livro ' . $name . ' não foi encontrado.';
        else
        $message = eclEndpoint_bookstoreLivro::bookRestrictions($this->page, $book, true);
        if(strlen($message))
            return $this->error(['message' => $message]);

        $folder = PATH_ROOT . 'livros/' . $name . '/';
        $files = [];

        if(is_dir($folder)) {
            foreach(scandir($folder) as $file) {
                if($file[0] == '.')
                    continue;

                $files[] = [
                    'name' => $file,
                    'size' => filesize($folder . $file)
            ];
            }
        }

        return $this->response(['files' => $files]);
    }

}
