<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_personal extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;
        $userId = intval($this->page->application->parent->name);

        $user = &$store->user->openById($userId);
        $userContent = $store->userContent->open($userId, '-personal');
        if (!$userContent)
            return $this->error('');

        $userContent['identifier'] = $user['name'];
        if (isset($input['text'])) {
            $formulary = $this->page->createFormulary('bookstoreAdminUsuarios_detalhes_personal_edit', $userContent);
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;
            $userContent = &$store->userContent->open($userId, '-personal');
            $userContent = $data;

            $user['name'] = $data['identifier'];
            foreach (['document', 'mail', 'phone'] as $key)
                $user[$key] = $data['details'][$key];
        }

        return $this->response($userContent);
    }

}
