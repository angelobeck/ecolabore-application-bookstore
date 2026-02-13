<?php

class eclEndpoint_bookstoreHome extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        return $this->response([
            'children' => self::children(),
            'recents' => self::recents(),
            'mensageria' => self::mensageria()
        ]);
    }

    private static function children(): array
    {
        global $store;
        $children = $store->bookstore_content->mode(1, 'section');
        return $children;
    }

    private static function recents(): array
    {
        global $io, $store;

        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'adult' => 0
        ];

        $recents = $io->database->select($store->bookstore_book, $where, 2, [], 'created', 'DESC');

        return $recents;
    }

    private static function mensageria(): array
    {
        $file = PATH_ROOT . 'mensageria.json';
        if (!is_file($file))
            return [];

        $json = file_get_contents($file);
        return eclIo_convert::json2array($json);
    }

    }
