<?php

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Command\Helpers;

class Printer
{
    public function output($message): void
    {
        echo $message;
    }

    public function newLine(): void
    {
        $this->output("\n");
    }

    public function display($message): void
    {
        $this->newLine();
        $this->output($message);
        $this->newLine();
    }
}
