<?php

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Command\Helpers;

use App\Command\Init;

abstract class CommandHelper
{
    protected $printer;
    protected $params;
    protected $signature;
    protected $description;

    public function __construct()
    {
        $this->printer = new Printer();
    }

    /**
     * @return mixed
     */
    abstract public function handle();

    /**
     * @return void
     */
    public function setPrinter(): void
    {
        $this->printer;
    }

    /**
     * @return Printer
     */
    public function getPrinter(): Printer
    {
        return $this->printer;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @return void
     */
    public function printSignature(): void
    {
        $this->getPrinter()->display(sprintf("command: %s", $this->getSignature()));
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return void
     */
    public function printDescription(): void
    {
        $this->getPrinter()->display(sprintf("usage: %s", $this->getDescription()));
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->handle();
    }

    /**
     * @return array
     */
    protected function getParams(): array
    {
        return array_values($this->params);
    }

    /**
     * @param $arg
     * @return bool
     */
    protected function hasParam($arg): bool
    {
        return in_array($arg, $this->params, true);
    }

    /**
     * @param $param
     * @return array
     */
    protected function getParam($param): array
    {
        return array_values($this->params);
    }
}
