<?php
define('BASE_PATH', dirname(__DIR__) . '/');
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createMutable(BASE_PATH);
$dotenv->load();