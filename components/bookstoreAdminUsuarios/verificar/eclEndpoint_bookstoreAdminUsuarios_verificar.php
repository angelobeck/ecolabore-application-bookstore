<?php

class eclEndpoint_bookstoreAdminUsuarios_verificar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;

        $userId = intval($this->page->application->name);
        $user = &$store->user->openById($userId);
        if(!$user)
            return $this->error();

        $userContent = $store->userContent->open($userId, '-personal');

        if(isset($input['action'])) {
if($input['action'] === 'accept')
    $user['verified'] = 4;
else if($input['action'] === 'reject')
$user['verified'] = 2;
        }

        $data = ['name' => $user['name']];
        if($user['kid'] > TIME)
            $data['kid'] = $user['kid'];

        return $this->response([
            'user' => $data,
            'userContent' => $userContent
        ]);
    }

}
