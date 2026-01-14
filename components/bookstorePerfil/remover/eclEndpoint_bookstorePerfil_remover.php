<?php

class eclEndpoint_bookstorePerfil_remover extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;

        if(!isset($input['ok']) or $input['ok'] !== 'ok')
            return $this->error();
        if(!isset($this->page->session['user']['name']))
            return $this->error();

        $name = $this->page->session['user']['name'];

        $user = &$store->user->open($name);
        if(!$user)
            return $this->error();
        $user['blocked'] = 1;

        $this->page->session = [];
        
        return $this->response();
    }

}
