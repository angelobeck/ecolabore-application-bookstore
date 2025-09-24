<?php

class eclEndpoint_bookstoreAdminContent_editar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $name = $this->page->application->parent->name;
        $page = &$store->bookstore_content->open(1, $name);
        if (!$page)
            return $this->error();

        if (isset($input['fields'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminContent_editar_edit', $page);
            $formulary->sanitize($input['fields']);
            if ($formulary->error)
                return $this->error($formulary->error);

            $page = $formulary->data;
        }

        return $this->response(['fields' => $page]);
    }

}
