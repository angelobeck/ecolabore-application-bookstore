<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_remover extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        if (!isset($input['ok']) || strtolower($input['ok']) != 'ok')
            return $this->error();
        $userId = intval($this->page->application->parent->name);
        $user = $store->user->openById($userId);
        if (!$user)
            return $this->error();

        $io->database->delete($store->userContent, ['user_id' => $userId]);
        $io->database->delete($store->user, ['id' => $userId]);

        return $this->response();
    }

}
