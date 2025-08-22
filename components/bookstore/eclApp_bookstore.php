<?php

class eclApp_bookstore extends eclApp
{
    public static $name = 'bookstore';
    public static $map = ['bookstoreHome', 'bookstoreLivros', 'bookstoreEstante', 'bookstoreComunidade', 'bookstoreAdmin', 'bookstoreCadastro', 'bookstoreLogin', 'bookstoreLogin_accessDenied', 'bookstoreLogin_invalidSession', 'bookstoreSobre', 'bookstoreNotFound', 'systemJavascript', 'systemStyle'];
    public static $content = 'bookstore_main';

    public static function dispatch(eclEngine_page $page): void
    {
        $page->modules->dialog = 'bookstore_modDialog_main';
        $page->modules->layout = 'bookstore_modLayout_main';
        $page->modules->levelUp = 'bookstore_modLevelUp_main';
        $page->modules->list = 'bookstore_modList_main';
        $page->modules->nav = 'bookstore_modNav_main';
        $page->modules->title = 'bookstore_modTitle_main';
        $page->modules->user = 'bookstore_modUser_main';

        $page->endpoints->livro = 'bookstore_livro';
    }
}
