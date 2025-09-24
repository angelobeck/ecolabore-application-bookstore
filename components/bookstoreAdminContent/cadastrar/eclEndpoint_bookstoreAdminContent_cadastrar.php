<?php

class eclEndpoint_bookstoreAdminContent_cadastrar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        if (!isset($input['fields']))
            return $this->error();

        $formulary = $this->page->createFormulary('bookstoreAdminContent_editar_edit');
        $formulary->sanitize($input['fields']);
        if ($formulary->error)
            return $this->error($formulary->error);

        $data = $formulary->data;
        $data['mode'] = 'section';
        $data['type'] = 'page';
        $store->bookstore_content->insert(1, $data);

        return $this->response(['fields' => $data]);
    }

}
