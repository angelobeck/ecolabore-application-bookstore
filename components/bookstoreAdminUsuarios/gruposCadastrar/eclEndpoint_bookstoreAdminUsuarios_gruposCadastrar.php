<?php

class eclEndpoint_bookstoreAdminUsuarios_gruposCadastrar extends eclEndpoint
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
