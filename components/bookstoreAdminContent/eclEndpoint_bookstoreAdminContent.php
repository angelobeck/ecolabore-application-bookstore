<?php

class eclEndpoint_bookstoreAdminContent extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $children = $store->bookstore_content->mode(1, 'section');
        return $this->response(['children' => $children]);
    }

}
