<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Requests;

class AddDataRequest extends BaseRequest
{
    protected function rules(): array
    {
        return [
            'county'        => ['required', 'string'],
            'country'       => ['required','string'],
            'town'          => ['required', 'string'],
            'address'       => ['required', 'string'],
            'description'   => ['required','string'],
            'latitude'      => ['required'],
            'longitude'     => ['required'],
            'num_bedrooms'  => ['required', 'integer', 'between:1,10'],
            'num_bathrooms' => ['required', 'integer', 'between:1,10'],
            'property_type' => ['required', 'string'],
            'type'          => ['required', 'in:rent,sale']
        ];
    }
}
