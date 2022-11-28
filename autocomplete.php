<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
require_once "init.php";
use App\Controllers\IndexController;

$data = (new IndexController())->autocomplete();

echo $data;

?>
