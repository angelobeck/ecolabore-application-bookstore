<?php

class eclEndpoint_bookstoreLogin extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        if (!isset($input['identifier']) || !isset($input['password']) || $input['identifier'] === '' || $input['password'] === '')
            return $this->error('');

        if ($input['identifier'] === ADMIN_NAME and password_verify($input['password'], ADMIN_PASSWORD)) {
            $createdSession = &$store->session->create();
            $createdSession['session']['user'] = ['name' => ADMIN_NAME];

            return $this->response([
                'user' => [
                    'name' => ADMIN_NAME,
                    'text' => ['title' => ADMIN_TITLE],
                    'details' => ['gender' => ADMIN_GENDER],
                    'groups' => ['-root' => 4, '-adult' => 4, '-verified' => 4],
                    'sessionId' => $createdSession['name'],
                    'sessionKey' => $createdSession['key']
                ]
            ]);
        }

        $user = self::findUser($input);
        if (!$user)
            return $this->error();
        if (isset($user['blocked']) && $user['blocked'])
            return $this->error();
        if (!password_verify($input['password'], $user['password']))
            return $this->error();

        $data = [];

        $userContent = $store->userContent->open($user['id'], '-public');
        if ($userContent) {
            $data['text'] = $userContent['text'];
        } else {
            $userContent = $store->userContent->open($user['id'], '-personal');
            if (!$userContent)
                return $this->error();

            $data['text'] = $userContent['text'];
        }

        $createdSession = &$store->session->create();
        $createdSession['session']['user'] = [
            'name' => $user['name'],
            'kid' => $user['kid'],
            'verified' => $user['verified']
        ];

        $groups = [];
        if (isset($user) and $user['verified'] == 4)
            $groups['-verified'] = 4;
        if (!isset($user['kid']) or $user['kid'] < TIME)
            $groups['adult'] = 4;

        foreach (explode(',', ADMIN_HELPERS) as $helperName) {
            $helperName = trim($helperName);
            if ($user['name'] === $helperName) {
                $groups['-root'] = 2;
                break;
            }
        }

        $data['name'] = $user['name'];
        $data['groups'] = $groups;
        $data['sessionId'] = $createdSession['name'];
        $data['sessionKey'] = $createdSession['key'];

        return $this->response([
            'user' => $data
        ]);
    }

    private static function findUser(array $input): array
    {
        global $io, $store;

        if (preg_match('/^[a-zA-Z0-9._-]+[@][a-zA-Z0-9_-]+[.][a-zA-Z0-9._-]+$/', $input['identifier'])) {
            $where = ['mail' => $input['identifier'], 'blocked' => 0];
            $rows = $io->database->select($store->user, $where);
            if ($rows)
                return $rows[0];
            else
                return [];
        }

        $numbersOnly = eclIo_convert::extractNumbers($input['identifier']);

        if (strlen($numbersOnly) === 11 or strlen($numbersOnly) === 9) {
            $where = ['document' => $numbersOnly, 'blocked' => 0];
            $rows = $io->database->select($store->user, $where);
            if ($rows)
                return $rows[0];
        }

        if (strlen($numbersOnly) >= 11) {
            $where = ['phone' => $numbersOnly, 'blocked' => 0];
            $rows = $io->database->select($store->user, $where);
            if ($rows)
                return $rows[0];
        }

        if (preg_match('/^[a-z0-9_-]+$/', $input['identifier'])) {
            $where = ['name' => $input['identifier'], 'blocked' => 0];
            $rows = $io->database->select($store->user, $where);
            if ($rows)
                return $rows[0];
        }

        return [];
    }

}
