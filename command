#!/usr/bin/php

<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

if(PHP_SAPI !== 'cli') {
    exit;
}
require_once "init.php";


use App\Command\Helpers\ListOfCommands;
use App\Command\Init;

if(count($argv) === 1){
    print("Error: incomplete command\n\n");
    exit;
}

if(empty(ListOfCommands::COMMAND_LIST[$argv[1]])){
    print("Error: command \"{$argv[1]}\" does not exists\n\n");
    exit;
}

$commandClass = ListOfCommands::COMMAND_LIST[$argv[1]];
$app = new $commandClass;
//$app->printSignature();
//$app->printDescription();
unset($argv[0], $argv[1]);
$app->params = $argv;
$app->run();


