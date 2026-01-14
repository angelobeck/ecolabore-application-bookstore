<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_status extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;

        $userId = intval($this->page->application->parent->name);
        $user = &$store->user->openById($userId);
        if (!$user)
            return $this->error();

        $userContent = $store->userContent->open($userId, '-personal');

        $document = '';
        $dir = PATH_USERS . $user['name'];
        if (is_dir($dir)) {
            foreach (scandir($dir) as $file) {
                if (substr($file, 0, 9) == '_document') {
                    $document = $file;
                    break;
                }
            }
        }

        if (isset($input['action'])) {
            if ($input['action'] === 'accept' and $document)
                $user['verified'] = 4;
            else if ($input['action'] === 'reject' and $document)
                $user['verified'] = 2;
            else if ($input['action'] === 'block')
                $user['blocked'] = 4;
            else if ($input['action'] === 'unblock')
                $user['blocked'] = 0;
            else if ($input['action'] === 'removedocument' and $document) {
                unlink(PATH_USERS . $user['name'] . '/' . $document);
                $document = '';
                $user['verified'] = 0;
            }
        }

        $data = [
            'name' => $user['name'],
            'verified' => $user['verified'],
            'blocked' => $user['blocked'],
            'kid' => $user['kid'] > TIME ? $user['kid'] : 0
        ];



        return $this->response([
            'user' => $data,
            'userContent' => $userContent,
            'document' => $document
        ]);
    }

}
