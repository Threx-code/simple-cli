<?php

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

use Illuminate\Database\Capsule\Manager as Capsule;

//$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
//$dotenv->load();

$capsule = new Capsule();
$capsule->addConnection([
    'driver'    => $_ENV['DB_DRIVER'],
    'host'      => $_ENV['DB_HOST'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'database'  => $_ENV['DB_DATABASE'],
    'charset'   => $_ENV['DB_CHARSET'],
    'collation' => $_ENV['DB_COLLATION']
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
