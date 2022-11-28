<?php

/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Controllers;

use App\Validation\Csrf as CSRF;
use Exception;

session_start();
CSRF::sameSessionId();
class Controller
{
    use CSRF;
    /*this should load model*/
    public function model($model)
    {
        require_once "System/Models/".$model.".php";
        return  "\\App\\Models\\$model";
    }

    public function view($view, $data =[])
    {
        extract($data, false);
        require_once "System/Views/".$view.".php";
    }

    /**
     * @throws Exception
     */
    public function csrf(): string
    {
        return CSRF::crfToken();
    }

    /**
     * @param $var
     * @return string|void
     * @throws Exception
     */
    public function checkToken($var)
    {
        return CSRF::checkToken($var);
    }

    /**
     * @param $var
     * @return mixed
     */
    public function sanitize($var)
    {
        return CSRF::sanitizeString($var);
    }
}
