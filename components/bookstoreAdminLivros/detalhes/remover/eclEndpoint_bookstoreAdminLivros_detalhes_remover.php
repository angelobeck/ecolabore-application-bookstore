<?php

class eclEndpoint_bookstoreAdminLivros_detalhes_remover extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if(!isset($input['ok']) or $input['ok'] !== 'ok')
            return $this->error('');

        $name = $this->page->application->parent->name;
        $where = [
            'mode' => eclStore_bookstore_book::MODE_BOOK,
            'name' => $name
    ];
$rows = $io->database->select($store->bookstore_book, $where, 1);

if(count($rows) >= 1) {
    $data = $rows[0];

$io->database->delete($store->bookstore_book, ['id' => $data['id']]);
}

return $this->response('ok');
    }

}
