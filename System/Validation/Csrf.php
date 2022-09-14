<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Validation;

use Exception;

trait Csrf
{
    /**
     * @param $var
     * @return mixed
     */
    public static function sanitizeString($var)
    {
        return filter_var(strip_tags(htmlentities(stripslashes($var))), FILTER_SANITIZE_STRING);
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function crfToken(): string
    {
        if (empty($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(32));
            htmlentities($_SESSION['_token'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        return $_SESSION['_token'];
    }

    /**
     * @return int|mixed
     */
    public static function tokenTime()
    {
        if (empty($_SESSION['_time'])) {
            $_SESSION['_time'] = time() + 3600;
        }
        return $_SESSION['_time'];
    }

    /**
     * @param $var
     * @return string|void
     * @throws Exception
     */
    public static function checkToken($var)
    {
        if (!empty($var) && time() < Csrf::tokenTime()) {
            if (hash_equals($var, Csrf::crfToken())) {
                return Csrf::crfToken();
            } else {
                echo "You need to refresh this page <a href=''>Click here</a>";
                unset($_SESSION['time'], $_SESSION['token']);
                exit;
            }
        } else {
            unset($_SESSION['time'], $_SESSION['token']);
            echo "Page expired, click here to <a href=''>Refresh</a>";
            exit;
        }
    }


    /**
     * @return void
     */
    public static function destroySession()
    {
        $_SESSION=array();
        if (session_id() !== '' || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        session_destroy();
    }

    /**
     * @return void
     */
    public static function sameSessionId()
    {
        session_id();
        session_regenerate_id();
    }
}
