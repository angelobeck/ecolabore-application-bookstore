<?php

class eclApp_bookstoreAdmin extends eclApp
{
    static $name = 'admin';
    static $map = ['bookstoreAdminAvisos', 'bookstoreAdminUsuarios', 'bookstoreAdminLivros', 'bookstoreAdminContent', 'bookstoreAdminSistema'];
    static $content = 'bookstoreAdmin_main';
    static $access = 2;
}
