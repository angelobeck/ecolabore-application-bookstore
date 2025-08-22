<?php

class eclEndpoint_bookstoreAdminSistema_request extends eclEndpoint
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
