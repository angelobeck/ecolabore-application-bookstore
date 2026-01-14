<?php

class eclEndpoint_bookstorePerfil_personal extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (!isset($this->page->session['user']['name']))
            return $this->error();

        $userName = $this->page->session['user']['name'];
        $user = &$store->user->open($userName);
        if(!$user)
            return $this->error();
        $userId = $user['id'];

        $userContent = $store->userContent->open($userId, '-personal');
        if (!$userContent)
            return $this->error();

        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstorePerfil_personal_edit', $userContent);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;
            $userContent = &$store->userContent->open($userId, '-personal');
            $userContent = $data;


            foreach (['mail', 'phone'] as $key)
                $user[$key] = $data['details'][$key];
        }

        return $this->response($userContent);
    }

}
