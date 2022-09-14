<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use App\Models\TableData;


class APIClient
{
    public const ENDPOINT = "/api/properties/";
    public const CONTENT_TYPE = "application/json";
    public const ACCEPT_TYPE = "application/json";

    /**
     * @return string
     * @throws GuzzleException
     */
    public function httpRequest(): string
    {
        try {
            $client = new Client(["base_uri" => $_ENV['BASE_URL']]);
            $response = $client->request('GET', self::ENDPOINT, [
                RequestOptions::HEADERS => $this->httpHeader(),
                RequestOptions::QUERY => $this->query()
            ]);

            $data = json_decode($response->getBody(), true);
            if (empty($data)) {
                return "Sorry no data from the external source";
            }

            foreach ($data['data'] as $key => $value) {
                $values = [];
                $values['county']           = $value['county'];
                $values['country']          = $value['country'];
                $values['town']             = $value['town'];
                $values['description']      =  $value['description'];
                $values['image']            = str_replace('1000', '999', $value['image_full']);
                $values['thumbnail']        = $value['image_thumbnail'];
                $values['latitude']         = $value['latitude'];
                $values['longitude']        = $value['longitude'];
                $values['num_bedrooms']     = $value['num_bedrooms'];
                $values['num_bathrooms']    = $value['num_bathrooms'];
                $values['price']            = $value['price'];
                $values['address']          = $value['address'];
                $values['property_type']    = json_encode(["type" => $value['property_type']['title'], "description" => $value['property_type']['description']]);
                $values['type']             = $value['type'];

                (new TableData())->insertIntoData($values);
            }
            return "Database insertion Completed";
        } catch (\Exception $e) {
            throw new \RuntimeException($e);
        }
    }

    /**
     * @return string[]
     */
    protected function query(): array
    {
        return [
            'api_key' => $_ENV['API_KEY']
        ];
    }


    /**
     * @return string[]
     */
    protected function httpHeader(): array
    {
        return [
            "Content-Type" => self::CONTENT_TYPE,
            "Accept" => self::ACCEPT_TYPE
        ];
    }
}
