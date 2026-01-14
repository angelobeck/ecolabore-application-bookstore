<?php

class eclEndpoint_bookstoreAdminUsuarios_detalhes_status_file extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        $userId = intval($this->page->application->parent->name);
        $user = &$store->user->openById($userId);
        $name = $user['name'];

        $received = [];
        if (isset($_FILES['file']['name']))
            $received = $_FILES['file'];
        else if (isset($_FILES['file'][0]))
            $received = $_FILES['file'][0];
        else
            return $this->error('bookstoreCadastro_errorFileNotFound');

        if ($received['size'] == 0)
            return $this->error('bookstoreCadastro_errorFileNotFound');
        if (isset($received['error']) && $received['error'])
            return $this->error('bookstoreCadastro_errorFileNotFound');

        $dir = PATH_USERS . $name;
        if (!is_dir($dir))
            mkdir($dir);

        $originalFilename = $received['name'];
        $parts = explode('.', $originalFilename);
        $extension = end($parts);
        $extension = strtolower($extension);

        switch ($extension) {
            case 'jpeg':
                $extension = 'jpg';
            case 'jpg':
            case 'pdf':
                $location = $dir . '/' . '_document.' . $extension;

                move_uploaded_file($received['tmp_name'], $location);
                $user['verified'] = 4;
                return $this->response();
        }
        return $this->error('bookstoreCadastro_errorFileType');
    }

}
