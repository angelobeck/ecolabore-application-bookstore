<?php

class eclApp_bookstoreAdminUsuarios_verificar_inlineImage extends eclApp
{
    public static $name = 'documento.jpg';

    public static function constructorHelper(eclEngine_application $me): void
    {
        $me->access = 0;
    }

    public static function dispatch(eclEngine_page $page): void
    {
        global $store;
        $id = intval($page->application->parent->name);
        $user = $store->user->openById($id);
        if (!$user)
            exit();
        $name = $user['name'];
        $location = PATH_USERS . $name . '/_document.jpg';
        ;

        if (is_file($location)) {
            eclIo_sendFile::send($location, ['Content-Disposition' => 'inline']);
            exit();
        }
    }

}
