<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Requests;

class UpdateDataRequest extends BaseRequest
{
    protected function rules(): array
    {
        return [
            'county'        => ['nullable', 'string'],
            'country'       => ['nullable','string'],
            'town'          => ['nullable', 'string'],
            'address'       => ['nullable', 'string'],
            'description'   => ['nullable','string'],
            'latitude'      => ['nullable'],
            'longitude'     => ['nullable'],
            'num_bedrooms'  => ['nullable', 'integer', 'between:1,10'],
            'num_bathrooms' => ['nullable', 'integer', 'between:1,10'],
            'property_type' => ['nullable', 'string'],
            'type'          => ['nullable', 'in:rent,sale']
        ];
    }
}
