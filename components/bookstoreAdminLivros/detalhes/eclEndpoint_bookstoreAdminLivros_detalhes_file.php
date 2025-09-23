<?php

class eclEndpoint_bookstoreAdminLivros_detalhes_file extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $store;
        $name = $this->page->application->name;

        $received = [];
        if (isset($_FILES['file']['name']))
            $received = $_FILES['file'];
        else if ($_FILES['file'][0])
            $received = $_FILES['file'][0];
        else
            return $this->error('');

        if ($received['size'] == 0)
            return $this->error('');
        if (isset($received['error']) && $received['error'])
            return $this->error('');

        $dir = PATH_ROOT . 'livros/' . $name;
        if (!is_dir($dir))
            mkdir($dir);

        $originalFilename = $received['name'];
        $parts = explode('.', $originalFilename);
        $extension = end($parts);
        $extension = strtolower($extension);

        $location = $dir . '/' . $name . '.' . $extension;

        move_uploaded_file($received['tmp_name'], $location);
        return $this->response();
    }
}
