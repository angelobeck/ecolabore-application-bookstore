<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_public extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $userId = intval($this->page->application->parent->name);

        $user = $store->user->openById($userId);
        $userPersonal = $store->userContent->open($userId, '-personal');
        $userContent = $store->userContent->open($userId, '-public');

        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminUsuarios_detalhes_public_edit', $userContent);
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
