<?php

define('SERVER_HOSTING_MODE', 'single'); // 'single', 'subfolders', 'subdomains'
define('SERVER_PROTOCOL', 'http:'); // 'http:', 'https:'
define('SERVER_HOST', 'localhost/ecolabore-application-bookstore/');
define('SERVER_REWRITE_ENGINE', false);
define('SERVER_SCRIPT_NAME', substr(__FILE__, 1 + strlen(__DIR__)));
define('SERVER_CONFIG_FILE', __DIR__ . '/config.php');
define('SERVER_DISPLAY_ERRORS', true);
define('SERVER_LOG_ERRORS', false);
define('SERVER_LOG_FILE', __DIR__ . '/bookstore_php_log.txt');
define('SERVER_DATABASE_LOG_FILE', __DIR__ . '/bookstore_database_log.txt');
define('SERVER_TIME_LIMIT', 3);

define('PATH_ROOT', __DIR__ . '/');
define('PATH_APPLICATION', __DIR__ . '/ecolabore-application-bookstore/');
define('PATH_ENGINE', __DIR__ . '/ecolabore-engine/');

define('MODULES', []);

include __DIR__ . '/ecolabore-engine/index.php';
