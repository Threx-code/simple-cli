<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Controllers;

class CreateTable
{
    public function runMigrations(): void
    {
        require_once "System/migrations/migrations.php";
    }
}
