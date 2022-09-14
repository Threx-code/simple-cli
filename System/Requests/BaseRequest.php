<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Requests;

use App\Validation\ValidationTrait as Validations;

abstract class BaseRequest
{
    use Validations;
    /**
     * Instance of Validator
     *
     * @var Validator
     */
    protected $validator = null;

    /**
     * Parameters to be validated
     *
     * @var array
     */
    protected $params = null;

    /**
     * Parameters to be validated
     *
     * @var array
     */
    protected $errors = null;

    /**
     * Validation rules for the given parameters
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Weather to throw an exception or return validator object
     *
     * @var array
     */
    protected $throwException = true;

    /**
     * Constructor
     *
     * @param array $params          Parameters to be validated
     * @param array $rules           Validation rules for the given parameters
     * @param bool $throwException Throw an exception or return validator object
     */
    public function __construct(
        array $params,
        array $rules = [],
        bool $throwException = true
    ) {
        $this->params = $params;
        $this->rules = $rules;
        $this->throwException = $throwException;
    }


    /**
     * Return an array of validation rules
     *
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * @return array[]|string[]|void
     */
    public function validate()
    {
        $value = $newError = $errors = [];
        if (empty($this->params)) {
            return [ 'validation_error' => 'No parameters provided'];
        }
        $validationRules = $this->rules();
        $this->params[] = $validationRules;

        foreach ($this->params as $key => $rules) {
            $value[$key] = $rules;
            if (is_array($rules)) {
                foreach ($rules as $newKey => $rule) {
                    $data = $value[$newKey] ?? null;
                    foreach ($rule as $valid) {
                        if ($valid === "nullable") {
                            $errors[] = null;
                            break;
                        } else {
                            switch ($valid) {
                                case "required":
                                    $errors[] = $this->required($newKey, $data);
                                    break;
                                case "integer":
                                    $errors[] = $this->integer($newKey, $data);
                                    break;
                                case "string":
                                    $errors[] = $this->string($newKey, $data);
                                    break;
                                case "array":
                                    $errors [] = $this->array($newKey, $data);
                                    break;
                                case "arrayinteger":
                                    $errors[] = $this->arrayinteger($newKey, $data);
                                    break;
                                case "arraystring":
                                    $errors[] = $this->arraystring($newKey, $data);
                                    break;
                                case "arrayelement":
                                    $errors[] = $this->arrayelement($newKey, $data);
                                    break;
                                case "uniquearray":
                                    $errors[] = $this->uniquearray($newKey, $data);
                                    break;
                                case "date":
                                    $errors[] = $this->date($newKey, $data);
                                    break;
                                case "email":
                                    $errors[] = $this->email($newKey, $data);
                                    break;
                                case (stripos($valid, 'after') !== false):
                                    $afterDate = explode(':', $valid);
                                    $after = $this->params[$afterDate[1]] ?? null;
                                    $afterName = $afterDate[1];
                                    $errors[] = $this->after($newKey, $data, $after, $afterName);
                                    break;
                                case (stripos($valid, 'before') !== false):
                                    $beforeDate = explode(':', $valid);
                                    $after = $this->params[$beforeDate[1]] ?? null;
                                    $beforeName = $beforeDate[1];
                                    $errors[] = $this->before($newKey, $data, $after, $beforeName);
                                    break;
                                case (stripos($valid, 'equal') !== false):
                                    $explode = explode(':', $valid);
                                    $equal = $this->params[$explode[1]] ?? null;
                                    $equalName = $explode[1];
                                    $errors[] = $this->equal($newKey, $data, $equal, $equalName);
                                    break;
                                case (stripos($valid, 'required_if') !== false):
                                    $explode = explode(':', $valid);
                                    $equal = $this->params[$explode[1]] ?? null;
                                    $equalName = $explode[1];
                                    $errors[] = $this->requiredIf($newKey, $data, $equal, $equalName);
                                    break;
                                case (stripos($valid, 'between') !== false):
                                    $explode = explode(':', $valid);
                                    $between = $explode[1];
                                    $errors[] = $this->between($newKey, $data, $between);
                                    break;
                                case (stripos($valid, 'max') !== false):
                                    $explode = explode(':', $valid);
                                    $max = $explode[1];
                                    $errors[] = $this->max($newKey, $data, $max);
                                    break;
                                case (stripos($valid, 'in') !== false):
                                    $explode = explode(':', $valid);
                                    $in = $explode[1];
                                    $errors[] = $this->in($newKey, $data, $in);
                                    break;
                            }
                        }
                    }
                }
            }
        }
        foreach ($errors as $error) {
            if (is_null($error)) {
                continue;
            }$newError[] = $error;
        }
        if (!empty($newError)) {
            return $newError;
        }
    }
}
