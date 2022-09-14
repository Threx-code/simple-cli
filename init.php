<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */


if( file_exists(__DIR__."/vendor/autoload.php") ){
    require_once "vendor/autoload.php";
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    require_once "System/config/database.php";
}else{
    echo "\n Sorry could not load all configuration files \n\n";
    exit;
}

