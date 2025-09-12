<?php

class eclEndpoint_bookstorePerfil extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;

        if (!isset($this->page->session['user']['name']))
            return $this->error();

        $name = $this->page->session['user']['name'];
        $user = $store->user->open($name);

        if (!$user)
            return $this->error();

        $userContent = $store->userContent->open($user['id'], '-public');

        $data = ['verified' => $user['verified']];
        if ($user['kid'] > TIME)
            $data['kid'] = $user['kid'];

        return $this->response([
            'user' => $data,
            'userContent' => $userContent
        ]);
    }

}
