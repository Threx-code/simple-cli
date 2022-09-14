<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
define('APP_PATH', dirname(__FILE__));
define('APP_FOLDER', dirname($_SERVER['SCRIPT_NAME']));

/* PLEASE NOT THAT THE APP_URI IS HTTP, YOU CAN CHANGE IT TO HTTPS IF YOU ARE RUNNING A SECURED APPLICATION LINK*/
define('APP_URI', 'http://'.$_SERVER['SERVER_NAME'].APP_FOLDER);
const SYS_PATH = APP_PATH . '/System';

?>
