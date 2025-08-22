<?php

class eclEndpoint_bookstoreAdminUsuarios_usuariosCadastrar extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        if (!isset($input['text']))
            return $this->error('');

        $formulary = $this->page->createFormulary('bookstoreAdminUsuarios_detalhes_personal_edit');
            $formulary->sanitize($input);
            if ($formulary->error)
                return $this->error($formulary->error);

            $data = $formulary->data;

            $user = [];
            $user['name'] = $data['identifier'];
            // $user['password'] = $data['password'];
            foreach (['document', 'mail', 'phone'] as $key)
                $user[$key] = $data['details'][$key];

            $userId = $store->user->insert($user);

            $data['mode'] = 'register';
        $data['name'] = '-personal';
                    $store->userContent->insert($userId, $data);

        return $this->response($data);
    }

}
