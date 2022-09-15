<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Requests;

class EditViewRequest extends BaseRequest
{

    protected function rules(): array
    {
        return [
            'item_no'        => ['required', 'integer'],
            'token'       => ['required','string'],
        ];
    }
}
