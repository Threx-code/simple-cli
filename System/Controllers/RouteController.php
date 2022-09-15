<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Controllers;

class RouteController
{
    public const ROUTE = [
        'add'       => ['AddDataController', 'index'],
        'index'     => ['IndexController', 'index'],
        'store'     => ['AddDataController', 'store'],
        'search'    => ['IndexController', 'search'],
        'edit'      => ['AddDataController', 'edit'],
        'update'    => ['AddDataController', 'update'],
        'delete'    => ['AddDataController', 'delete']
    ];
}
