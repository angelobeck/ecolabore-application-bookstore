<?php

class eclEndpoint_bookstoreCadastro extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (!isset($input['step']) or !isset($input['fields']))
            return $this->error('');

        $formularyName = $this->getFormularyName($input['step'], $input['fields']);
        $formulary = $this->page->createFormulary($formularyName, $input['fields']);

        if ($formulary->sanitize($input['fields'])) {
            if ($input['step'] === 5) {
                $data = $formulary->data;

                $user = [
                    'name' => $data['identifier'],
                    'phone' => $data['details']['phone'],
                    'mail' => $data['details']['mail'],
                    'document' => $data['details']['document'],
                    'password' => $data['password'],
                    'kid' => $data['minor']
                ];

                $userId = $store->user->insert($user);

                $userPersonal = $data;
                ;
                $userPersonal['name'] = '-personal';
                $userPersonal['mode'] = 'register';
                $userPersonal['encrypt'] = true;

                $store->userContent->insert($userId, $userPersonal);

                $userPublic = [
                    'name' => '-public',
                    'mode' => 'register',
                    'text' => ['title' => $data['text']['nick']]
                ];

                $keywords = $userPersonal['text']['title']['pt']['value'] ?? '';
                $keywords .= ' ' . $userPublic['text']['title']['pt']['value'] ?? '';
                $keywords .= ' ' . $user['name'];

                $userPublic['keywords'] = eclIo_database::filterKeywords($keywords);

                $store->userContent->insert($userId, $userPublic);

                $createdSession = &$store->session->create();
                $createdSession['session']['user'] = ['name' => $user['name']];

                $groups = [];
                $session = [];
        if (!isset($user['kid']) or $user['kid'] < TIME)
            $groups['adult'] = 4;

                $session['name'] = $user['name'];
                $session['text'] = ['title' => $userPublic['text']['title']];
                $session['groups'] = $groups;
                $session['sessionId'] = $createdSession['name'];
                $session['sessionKey'] = $createdSession['key'];

                return $this->response([
                    'user' => $session,
                    'fields' => $formulary->data
                ]);

            } else if ($input['step'] === 6) {

            }
            return $this->response(['fields' => $formulary->data]);
        }

        return $this->error($formulary->error);
    }

    private function getFormularyName(string $step, array $fields): string
    {
        switch ($step) {
            case '1':
                return 'bookstoreCadastro_formularyStart';
            case '2':
                if (isset($fields['minor']) and $fields['minor'])
                    return 'bookstoreCadastro_formularySponsor';
                else
                    return 'bookstoreCadastro_formularyPersonal';
            case '3':
                return 'bookstoreCadastro_formularyPublic';
            case '4':
                return 'bookstoreCadastro_formularyLogin';
            case '5':
                return 'bookstoreCadastro_formularyCheckout';
            case '6':
            default:
                return 'bookstoreCadastro_formularyDocument';
        }
    }

}
