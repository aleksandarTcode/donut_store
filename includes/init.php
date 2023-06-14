<?php
require_once ("config.php");
require_once ("functions.php");
require_once ("database.php");
require_once ("User.php");
require_once ("Order.php");
require_once ("Product.php");

require_once __DIR__ . '/../vendor/autoload.php';

\Dotenv\Dotenv::createImmutable(paths: __DIR__)->load();
?>