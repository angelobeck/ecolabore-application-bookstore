<?php

class eclEndpoint_bookstoreComunidade_usuariosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        $where = ['blocked' => 0];
        $users = $io->database->select($store->user, $where);
        $activeUsers = [];
        foreach($users as $row) {
            $activeUsers[$row['id']] = true;
        }

        $where = ['name' => '-public'];
            $rows = $io->database->select($store->userContent, $where);

            $children = [];
            foreach($rows as $row) {
                if(isset($activeUsers[$row['user_id']]))
                    $children[] = $row;
            }
            return $this->response(['children' => $children]);
    }

}
