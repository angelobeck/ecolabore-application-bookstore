<?php

class eclEndpoint_bookstoreAdminLivros_detalhes_registro extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $name = $this->page->application->parent->name;
        $rows = $io->database->select($store->bookstore_book, ['name' => $name], 1);

        if (!$rows)
            return $this->error('');

        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminLivros_detalhes_edit', $rows[0]);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = self::prepareBook($formulary->data);
            $io->database->update($store->bookstore_book, $data, $rows[0]);
            return $this->response($data);
        }

        return $this->response($rows[0]);
    }

    public static function prepareBook(array $data): array
    {
        $keywords1 = '';
        $keywords2 = '';
        $keywords3 = '';

        $data['mode'] = eclStore_bookstore_book::MODE_BOOK;
        $data['name'] = eclIo_convert::slug($data['text']['title']['pt']['value']);

        if (isset($data['text']['author'])) {
            $data['author_name'] = eclIo_convert::slug($data['text']['author']['pt']['value']);
            self::checkAndInsert($data['author_name'], $data['text']['author']['pt']['value'], eclStore_bookstore_book::MODE_AUTHOR);
        }
        if (isset($data['text']['narrator'])) {
            $data['narrator_name'] = eclIo_convert::slug($data['text']['narrator']['pt']['value']);
            self::checkAndInsert($data['narrator_name'], $data['text']['narrator']['pt']['value'], eclStore_bookstore_book::MODE_NARRATOR);
        }
        if (isset($data['text']['genre'])) {
            $data['genre_name'] = eclIo_convert::slug($data['text']['genre']['pt']['value']);
            self::checkAndInsert($data['genre_name'], $data['text']['genre']['pt']['value'], eclStore_bookstore_book::MODE_GENRE);
        }
        if (isset($data['text']['collection'])) {
            $data['collection_name'] = eclIo_convert::slug($data['text']['collection']['pt']['value']);
            self::checkAndInsert($data['collection_name'], $data['text']['collection']['pt']['value'], eclStore_bookstore_book::MODE_COLLECTION);
        }
        if (isset($data['details']['braille']))
            $data['format_braille'] = 1;
        if (isset($data['details']['duration']))
            $data['format_audio'] = 1;

        foreach (explode(' ', 'author title original translator publisher genre collection synopsis keywords narrator notes') as $name) {
            if (isset($data['text'][$name])) {
                switch ($name) {
                    case 'title':
                    case 'original':
                    case 'collection':
                        $keywords1 .= ' ' . $data['text'][$name]['pt']['value'];
                        break;

                    case 'author':
                    case 'translator':
                    case 'narrator':
                    case 'keywords':
                        $keywords2 .= ' ' . $data['text'][$name]['pt']['value'];
                        break;

                    case 'genre':
                    case 'publisher':
                    case 'synopsis':
                        $keywords3 .= ' ' . $data['text'][$name]['pt']['value'];
                        break;
                }
            }
        }

        $keywords1 = eclIo_database::filterKeywords($keywords1);
        $keywords2 = eclIo_database::filterKeywords($keywords2);
        $keywords3 = eclIo_database::filterKeywords($keywords3);

        $data['details']['keywords1'] = $keywords1;
        $data['details']['keywords2'] = $keywords2;

        $data['keywords'] = eclIo_database::filterKeywords(trim($keywords1 . ' ' . $keywords2 . ' ' . $keywords3));

        if (strpos($data['keywords'], 'juvenil') !== false)
            $data['kids'] = 1;
        else if (strpos($data['genre_name'], 'juvenil') !== false)
            $data['kids'] = 1;
        else if (strpos($data['genre_name'], 'infant') !== false)
            $data['kids'] = 1;

        if (strpos($data['keywords'], 'eroti') !== false)
            $data['adult'] = 1;

        return $data;
    }

    private static function checkAndInsert(string $name, string $title, string $mode): void
    {
        global $io, $store;

        $where = [
            'name' => $name,
            'mode' => $mode
        ];
        $rows = $io->database->select($store->bookstore_book, $where);
        if ($rows)
            return;

        $data = [
            'name' => $name,
            'mode' => $mode,
            'text' => ['title' => ['pt' => ['value' => $title]]]
        ];
        $store->bookstore_book->insert($data);
    }

}
