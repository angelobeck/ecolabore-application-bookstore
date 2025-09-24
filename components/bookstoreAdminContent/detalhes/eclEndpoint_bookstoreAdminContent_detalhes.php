<?php

class eclEndpoint_bookstoreAdminContent_detalhes extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $name = $this->page->application->name;
        $page = $store->bookstore_content->open(1, $name);
        return $this->response(['page' => $page]);
    }

}
