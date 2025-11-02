<?php

class eclEndpoint_bookstoreCadastro_file extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

        if (!isset($this->page->session['user']['name']))
            return $this->error('');

        $name = $this->page->session['user']['name'];
        $user = &$store->user->open($name);

        $received = [];
        if (isset($_FILES['file']['name']))
            $received = $_FILES['file'];
        else if ($_FILES['file'][0])
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
            case 'jpg':
            case 'jpeg':
            case 'pdf':
                $location = $dir . '/' . '_document.' . $extension;

                move_uploaded_file($received['tmp_name'], $location);
                $user['verified'] = 1;
                return $this->response();
        }
        return $this->error('bookstoreCadastro_errorFileType');
    }

}
