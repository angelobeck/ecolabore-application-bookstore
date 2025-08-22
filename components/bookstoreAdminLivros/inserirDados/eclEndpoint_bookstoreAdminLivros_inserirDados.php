<?php

class eclEndpoint_bookstoreAdminLivros_inserirDados extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        set_time_limit(60);
        $message = count($input);

        $total = count($input);
        $counter = 0;

        $author = [];
        $genre = [];
        $collection = [];
        $narrator = [];

        foreach ($input as $row) {

            $data = [
                'text' => [],
                'details' => []
            ];
            $keywords1 = '';
            $keywords2 = '';
            $keywords3 = '';

            $data['mode'] = eclStore_bookstore_book::MODE_BOOK;
            $data['name'] = $row['name'];

            if (isset($row['author'])) {
                $data['author_name'] = eclIo_convert::slug($row['author']);
                $author[$data['author_name']] = $row['author'];
            }
            if (isset($row['narrator'])) {
                $data['narrator_name'] = eclIo_convert::slug($row['narrator']);
                $narrator[$data['narrator_name']] = $row['narrator'];
            }
            if (isset($row['genre'])) {
                $data['genre_name'] = eclIo_convert::slug($row['genre']);
                $genre[$data['genre_name']] = $row['genre'];
            }
            if (isset($row['collection'])) {
                $data['collection_name'] = eclIo_convert::slug($row['collection']);
                $collection[$data['collection_name']] = $row['collection'];
            }
            if (isset($row['braille']))
                $data['format_braille'] = 1;
            if (isset($row['duration']))
                $data['format_audio'] = 1;
            if (isset($row['format']))
                $data['format_ink'] = 1;
            if (isset($row['public']))
                $data['public'] = 1;

            if (strpos(eclIo_database::filterKeywords($row['keywords']), 'juvenil') !== false)
                $data['kids'] = 1;
            else if (strpos($data['genre_name'], 'juvenil') !== false)
                $data['kids'] = 1;
            else if (strpos($data['genre_name'], 'infant') !== false)
                $data['kids'] = 1;

            foreach (explode(' ', 'author title original translator publisher genre collection synopsis keywords narrator notes') as $name) {
                if (isset($row[$name])) {
                    $data['text'][$name] = ['pt' => ['value' => $row[$name]]];
                    switch ($name) {
                        case 'title':
                        case 'original':
                        case 'collection':
                            $keywords1 .= ' ' . $row[$name];
                            break;

                        case 'author':
                        case 'translator':
                        case 'narrator':
                        case 'keywords':
                            $keywords2 .= ' ' . $row[$name];
                            break;

                        case 'genre':
                        case 'publisher':
                        case 'synopsis':
                            $keywords3 .= ' ' . $row[$name];
                            break;
                    }
                }
            }

            foreach (explode(' ', 'year language pages braille duration platform') as $name) {
                if (isset($row[$name]))
                    $data['details'][$name] = $row[$name];
            }

            $keywords1 = eclIo_database::filterKeywords($keywords1);
            $keywords2 = eclIo_database::filterKeywords($keywords2);
            $keywords3 = eclIo_database::filterKeywords($keywords3);

            $data['details']['keywords1'] = $keywords1;
            $data['details']['keywords2'] = $keywords2;

            $data['keywords'] = eclIo_database::filterKeywords(trim($keywords1 . ' ' . $keywords2 . ' ' . $keywords3));
            $store->bookstore_book->insert($data);
            $counter++;
        }

        foreach ($author as $name => $title) {
            $data = [
                'name' => $name,
                'mode' => eclStore_bookstore_book::MODE_AUTHOR,
                'text' => ['title' => ['pt' => ['value' => $title]]]
            ];
            $store->bookstore_book->insert($data);
        }

        foreach ($genre as $name => $title) {
            $data = [
                'name' => $name,
                'mode' => eclStore_bookstore_book::MODE_GENRE,
                'text' => ['title' => ['pt' => ['value' => $title]]]
            ];
            $store->bookstore_book->insert($data);
        }

        foreach ($narrator as $name => $title) {
            $data = [
                'name' => $name,
                'mode' => eclStore_bookstore_book::MODE_NARRATOR,
                'text' => ['title' => ['pt' => ['value' => $title]]]
            ];
            $store->bookstore_book->insert($data);
        }

        foreach ($collection as $name => $title) {
            $data = [
                'name' => $name,
                'mode' => eclStore_bookstore_book::MODE_COLLECTION,
                'text' => ['title' => ['pt' => ['value' => $title]]]
            ];
            $store->bookstore_book->insert($data);
        }

        return [
            'response' => [
                'message' => 'Inserindo dados...',
                'input' => 'Inseridos ' . $counter . ' de ' . $total
            ]
        ];
    }

}
