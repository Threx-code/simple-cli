<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\kernel;

use App\Controllers\RouteController;

require_once "System/Validation/Csrf.php";

class App
{
    protected $controller ='IndexController';
    protected $method = 'index';
    protected $param = [];

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        if (!empty(RouteController::ROUTE[$url[1]])) {
            $this->controller = RouteController::ROUTE[$url[1]][0];
            $this->method = RouteController::ROUTE[$url[1]][1];
        }
        require_once "System/Controllers/".$this->controller. ".php";
        $this->controller = "\\App\\Controllers\\$this->controller";

        if (!method_exists($this->controller, $this->method)) {
            throw new \RuntimeException(sprintf('Error: method %s does not exist', $this->method));
        }

        $this->param = $url ? array_values($url) : [];

        call_user_func_array([new ($this->controller), $this->method], $this->param);
    }


    public function parseUrl()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            return explode("/", filter_var(rtrim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL));
        }
    }
}
