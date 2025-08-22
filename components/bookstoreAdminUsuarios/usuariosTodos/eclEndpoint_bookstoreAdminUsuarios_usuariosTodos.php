<?php

class eclEndpoint_bookstoreAdminUsuarios_usuariosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $where = ['name' => '-personal'];
            $rows = $io->database->select($store->userContent, $where);

            return $this->response(['children' => $rows]);
    }

}
