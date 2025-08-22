<?php

class eclEndpoint_bookstoreAdminUsuarios_gruposTodos extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        return [
            'response' => [
                'message' => 'Olá mundo!',
                'input' => $input
            ]
        ];
    }

}
