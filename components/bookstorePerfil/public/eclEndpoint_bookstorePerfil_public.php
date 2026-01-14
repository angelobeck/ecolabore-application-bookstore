<?php

class eclEndpoint_bookstorePerfil_public extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if(!isset($this->page->session['user']['name']))
            return $this->error();

$userName = $this->page->session['user']['name'];

        $user = $store->user->open($userName);
        if(!$user)
            return $this->error();
        $userId = $user['id'];

        $userPersonal = $store->userContent->open($userId, '-personal');
        $userContent = $store->userContent->open($userId, '-public');

        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstorePerfil_public_edit', $userContent);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;
            $data['mode'] = 'register';
            $data['name'] = '-public';

            $keywords = $userPersonal['text']['title']['pt']['value'] ?? '';
            $keywords .= ' ' . $data['text']['title']['pt']['value'] ?? '';
            $keywords .= ' ' . $user['name'];

            $data['keywords'] = eclIo_database::filterKeywords($keywords);

            if (!$userContent) {
                $store->userContent->insert($userId, $data);
            } else {
                $userContent = &$store->userContent->open($userId, '-public');
                $userContent = $data;
            }
        }

        if (!$userContent) {
            $data = $userPersonal;

            if (!$data)
                return $this->error('');

            $userContent['text'] = $data['text'];
        }

        return $this->response($userContent);
    }

}
