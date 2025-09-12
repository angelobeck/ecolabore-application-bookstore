<?php

class eclEndpoint_bookstoreComunidade_usuariosTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $where = ['name' => '-public'];
            $rows = $io->database->select($store->userContent, $where);

            return $this->response(['children' => $rows]);
    }

}
