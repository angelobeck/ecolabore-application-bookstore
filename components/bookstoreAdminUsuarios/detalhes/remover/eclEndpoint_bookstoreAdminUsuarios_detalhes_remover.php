<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_remover extends eclEndpoint
{

    public function dispatch(array $input): array
    {
global $io, $store;
        $userId = intval($this->page->application->parent->name);
        $user = $store->user->openById($userId);
        ecl_log($user);

        return $this->error();
    }

}
