<?php

class eclEndpoint_bookstoreAdminUsuarios_semDocumentoLista extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        $where = ['verified' => 0];
        $users = $io->database->select($store->user, $where);
        $children = [];
        foreach ($users as $user) {
            $userId = $user['id'];
            $where = [
                'name' => '-personal',
                'user_id' => $userId
            ];

            $rows = $io->database->select($store->userContent, $where);
            if ($rows)
                $children[] = $rows[0];
        }

        return $this->response(['children' => $children]);
    }

}
