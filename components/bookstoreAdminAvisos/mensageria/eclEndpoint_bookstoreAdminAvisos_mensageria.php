<?php

class eclEndpoint_bookstoreAdminAvisos_mensageria extends eclEndpoint
{

    public function dispatch(array $input): array
    {
        global $io, $store;

$file = PATH_ROOT . 'mensageria.json';

        if (isset($input['content'])) {
$content = eclIo_convert::array2json($input);

file_put_contents($file, $content);
return $this->response();
        }
        
        $data = file_get_contents($file);
        return $this->response(eclIo_convert::json2array($data));
    }

}
