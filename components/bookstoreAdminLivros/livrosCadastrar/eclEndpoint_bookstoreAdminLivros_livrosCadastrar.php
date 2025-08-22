<?php

class eclEndpoint_bookstoreAdminLivros_livrosCadastrar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        if (!isset($input['text']))
            return $this->error('');

        $formulary = $this->page->createFormulary('bookstoreAdminLivros_detalhes_edit');
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;

                        $keywords1 = '';
            $keywords2 = '';
            $keywords3 = '';

            $data['mode'] = eclStore_bookstore_book::MODE_BOOK;
            $data['name'] = eclIo_convert::slug($data['text']['title']['pt']['value']);

            if (isset($data['text']['author'])) {
                $data['author_name'] = eclIo_convert::slug($data['text']['author']['pt']['value']);
                $author[$data['author_name']] = $data['text']['author'];
            }
            if (isset($data['text']['narrator'])) {
                $data['narrator_name'] = eclIo_convert::slug($data['text']['narrator']['pt']['value']);
                $narrator[$data['narrator_name']] = $data['text']['narrator'];
            }
            if (isset($data['text']['genre'])) {
                $data['genre_name'] = eclIo_convert::slug($data['text']['genre']['pt']['value']);
                $genre[$data['genre_name']] = $data['text']['genre'];
            }
            if (isset($data['text']['collection'])) {
                $data['collection_name'] = eclIo_convert::slug($data['text']['collection']['pt']['value']);
                $collection[$data['collection_name']] = $data['text']['collection'];
            }
            if (isset($data['details']['braille']))
                $data['format_braille'] = 1;
            if (isset($data['details']['duration']))
                $data['format_audio'] = 1;

            if (strpos(eclIo_database::filterKeywords($data['text']['keywords']['pt']['value']), 'juvenil') !== false)
                $data['kids'] = 1;
            else if (strpos($data['genre_name'], 'juvenil') !== false)
                $data['kids'] = 1;
            else if (strpos($data['genre_name'], 'infant') !== false)
                $data['kids'] = 1;

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
            $store->bookstore_book->insert($data);

            return $this->response($data);
    }

}
