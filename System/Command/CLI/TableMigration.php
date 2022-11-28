<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Command\CLI;

use App\Command\Helpers\CommandHelper;

class TableMigration extends CommandHelper
{
    public $signature = 'migration';
    public $description = 'This command allows you to migrate all your database table';
    public $params;

    public function handle()
    {
        $this->getPrinter()->display("========== Running migration ===========");
        require_once "System/migrations/migrations.php";
    }
}
