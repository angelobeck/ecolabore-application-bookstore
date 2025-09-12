<?php

class eclEndpoint_bookstoreComunidade_perfil extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;

        $userId = intval($this->page->application->name);
        $user = &$store->user->openById($userId);
        if(!$user)
            return $this->error();

        $userContent = $store->userContent->open($userId, '-public');

        $data = ['name' => $user['name']];
        if($user['kid'] > TIME)
            $data['kid'] = $user['kid'];

        return $this->response([
            'user' => $data,
            'userContent' => $userContent
        ]);
    }

}
