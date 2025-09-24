<?php

class eclEndpoint_bookstoreAdminContent_remover extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (!isset($input['ok']) or $input['ok'] !== 'ok')
            return $this->error();

        $name = $this->page->application->parent->name;
        $data =$store->bookstore_content->open(1, $name);
        if (!$data)
            return $this->error();

        $io->database->delete($store->bookstore_content, ['id' => $data['id']]);

        return $this->response('ok');
    }

}
