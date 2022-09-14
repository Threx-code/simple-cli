<?php

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Command\Helpers;

use App\Command\CLI\APICommand;

class ListOfCommands
{
    public const COMMAND_LIST = [
        'api:consume' => APICommand::class,
        'help:list' => "HelpCommand",
    ];
}
