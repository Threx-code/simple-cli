<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Requests;

class SearchRequest extends BaseRequest
{
    protected function rules(): array
    {
        return [
            'search' => ['required', 'string']
        ];
    }
}
