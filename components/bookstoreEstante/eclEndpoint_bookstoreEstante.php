<?php

class eclEndpoint_bookstoreEstante extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        return [
            'response' => $input
        ];
    }

}
