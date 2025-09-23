<?php

class eclEndpoint_bookstoreAdminLivros_livrosCadastrar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        if (!isset($input['text']))
            return $this->error('');

        $formulary = $this->page->createFormulary('bookstoreAdminLivros_detalhes_edit');
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = eclEndpoint_bookstoreAdminLivros_detalhes_registro::prepareBook($formulary->data);

                    $where = [
            'name' => $data['name'],
            'mode' => eclStore_bookstore_book::MODE_BOOK
        ];
        $rows = $io->database->select($store->bookstore_book, $where);
        if($rows)
            $data['name'] = eclIo_convert::slug($data['name'] . '_-_' . $data['author_name']);

            $store->bookstore_book->insert($data);

            return $this->response($data);
    }

}
