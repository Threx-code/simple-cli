<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Validation;

trait ValidationTrait
{
    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function required($key, $data)
    {
        if ($data == null) {
            return $this->error($key, "field is required");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function integer($key, $data)
    {
        $number = preg_replace('!\s+!', '', $data);
        if (!is_numeric($number)) {
            return  $this->error($key, "field should be an integer");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function string($key, $data)
    {
        if (!is_string($data)) {
            return  $this->error($key, "field should be a string");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function array($key, $data)
    {
        if (!is_array($data)) {
            return  $this->error($key, "field should be an array");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function arrayinteger($key, $data)
    {
        $attr = "/^\d+$/";
        if (is_array($data)) {
            foreach ($data as $count => $value) {
                if (!preg_match($attr, $value)) {
                    $num = (int)$count+1;
                    return  $this->error($key, "contains invalid data type, only numbers allowed on element $num");
                }
            }
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function arraystring($key, $data)
    {
        $attr = "/^[ A-Za-z0-9._-]+$/";
        if (is_array($data)) {
            foreach ($data as $count => $value) {
                if (!preg_match($attr, $value)) {
                    $num = (int)$count+1;
                    return  $this->error($key, "contains invalid data type. Check element $num");
                }
            }
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function arrayelement($key, $data)
    {
        if (is_array($data) && ($data != array_filter($data))) {
            foreach ($data as $count => $value) {
                $num = (int)$count+1;
                if ($value === "") {
                    return  $this->error($key, "contains empty element. Check element $num");
                }
            }
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function uniquearray($key, $data)
    {
        if (is_array($data) && (count($data) != count(array_unique($data)))) {
            return  $this->error($key, "Cannot contain same value ");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function email($key, $data)
    {
        if (!(bool)filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return  $this->error($key, "must be a valid email");
        }
    }

    /**
     * @param $key
     * @param $data
     * @return array|void
     */
    public function date($key, $data)
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data)) {
            return  $this->error($key, "must be a valid date format (YYYY-MM-DD)");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $after
     * @param $afterName
     * @return array|void
     */
    public function after($key, $data, $after, $afterName)
    {
        if ($data < $after) {
            return  $this->error($key, "must be greater than $afterName");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $after
     * @param $beforeName
     * @return array|void
     */
    public function before($key, $data, $after, $beforeName)
    {
        if ($data > $after) {
            return  $this->error($key, "must be less than $beforeName");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $equal
     * @param $equalName
     * @return array|void
     */
    public function equal($key, $data, $equal, $equalName)
    {
        if ($data != $equal) {
            return  $this->error($key, "must be equal to $equalName");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $equal
     * @param $equalName
     * @return array|void
     */
    public function requiredIf($key, $data, $equal, $equalName)
    {
        if (empty($equal) && empty($data)) {
            return  $this->error($key, "is required when $equalName is empty");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $between
     * @return array|void
     */
    public function between($key, $data, $between)
    {
        $explode = explode(',', $between);
        if (($data < $explode[0]) || ($data > $explode[1])) {
            return  $this->error($key, "should be between $explode[0] and $explode[1]");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $max
     * @return array|void
     */
    public function max($key, $data, $max)
    {
        if ($data > $max) {
            return  $this->error($key, "cannot be greater than $max");
        }
    }

    /**
     * @param $key
     * @param $data
     * @param $in
     * @return array|void
     */
    public function in($key, $data, $in)
    {
        $explode = explode(',', $in);
        if(!in_array($data, $explode, true)){
            return  $this->error($key, "should be one of [". implode(', ', $explode) . "]");
        }
    }

    /**
     * @param $key
     * @param $error
     * @return array
     */
    public function error($key, $error): array
    {
        return [
            $key => $error
        ];
    }
}
