<?php

class eclApp_bookstoreAdminSistema extends eclApp
{
    public static $name = 'sistema';
    public static $map = ['bookstoreAdminSistema_request', 'bookstoreAdminSistema_php', 'bookstoreAdminSistema_export', 'bookstoreAdminLivros_inserirDados'];
    public static $content = 'bookstoreAdminSistema_main';
    public static $access = 4;
}
