<?php

class eclEndpoint_bookstorePerfil_password extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if(!isset($this->page->session['user']['name']))
            return $this->error();

        $userName = $this->page->session['user']['name'];

        if(!isset($input['password']))
            return $this->error('');

        $user = &$store->user->open($userName);
        $user['password'] = $input['password'];

        return $this->response('');
            }
}
