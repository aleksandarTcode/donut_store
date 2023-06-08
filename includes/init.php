<?php
require_once ("config.php");
require_once ("functions.php");
require_once ("database.php");
require_once ("user.php");
require_once ("order.php");

require_once __DIR__ . '/../vendor/autoload.php';

\Dotenv\Dotenv::createImmutable(paths: __DIR__)->load();
?>