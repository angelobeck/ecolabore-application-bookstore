<?php

class eclEndpoint_bookstorePerfil extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        return [
            'response' => $input
        ];
    }

}
