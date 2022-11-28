<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Command\CLI;

use App\Command\Helpers\CommandHelper;
use App\Services\APIClient;
use GuzzleHttp\Exception\GuzzleException;

class APICommand extends CommandHelper
{
    public $signature = 'api:consume';
    public $description = 'This command allows you to fetch data from external source';
    public $params;

    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->getPrinter()->display("========== Fetching data from external source =========== \n\n");
        $result = (new APIClient())->httpRequest();
        $this->getPrinter()->display("==========" . $result . "==============\n\n");
    }
}
