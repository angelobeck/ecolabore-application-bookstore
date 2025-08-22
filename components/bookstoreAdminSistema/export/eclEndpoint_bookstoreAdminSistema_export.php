<?php

class eclEndpoint_bookstoreAdminSistema_export extends eclEndpoint
{

    public function dispatch(array $input): array
    {

        $buffer = eclApp_systemJavascript_application::generate_script($this->page);
        $fileName = PATH_CACHE . PACK_NAME . TIME . '.js';
        file_put_contents($fileName, $buffer);

        $buffer = eclApp_systemStyle_application::generate_style($this->page);
        $fileName = PATH_CACHE . PACK_NAME . TIME . '.css';
        file_put_contents($fileName, $buffer);

        $buffer = eclApp_systemPack_application::pack();
        $fileName = PATH_CACHE . PACK_NAME . '.php';
        file_put_contents($fileName, $buffer);

        return [
            'response' => $input
        ];
    }

}
