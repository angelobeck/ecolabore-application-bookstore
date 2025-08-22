<?php

class eclApp_bookstoreNotFound extends eclApp
{
    public static $name = '-not-found';
    public static $content = 'bookstoreNotFound_main';

    public static function constructorHelper(eclEngine_application $me): void
    {
        $me->ignoreSubfolders = true;
    }

}
