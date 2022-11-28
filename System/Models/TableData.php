<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Models;

use App\Validation\Csrf;
use Illuminate\Database\Eloquent\Model as Eloquent;

class TableData extends Eloquent
{
    use Csrf;
    protected $table = 'table_data';
    //protected $fillable = [];
    protected $guarded =[];

    /**
     * @return int
     */
    public function perPage(): int
    {
        return 10;
    }

    /**
     * @param $pageNum
     * @return float|int
     */
    public function offset($pageNum)
    {
        return (int)($pageNum - 1) * $this->perPage();
    }

    /**
     * @param $pageNum
     * @return int
     */
    public function previousPage($pageNum): int
    {
        return $pageNum - 1;
    }

    /**
     * @param $pageNum
     * @return int
     */
    public function nextPage($pageNum): int
    {
        return $pageNum + 1;
    }

    /**
     * @return int
     */
    public function adjacent(): int
    {
        return 2;
    }

    /**
     * @param float $offset
     * @param int $per_page
     * @return mixed
     */
    public function getData(float $offset, int $per_page)
    {
        return $this::orderby('id', 'desc')->where('deleted', null)->offset($offset)->limit($per_page)->get();
    }

    /**
     * @return mixed
     */
    public function countRecord()
    {
        return $this::where('deleted', null)->count('id');
    }

    /**
     * @param $value
     * @return void
     */
    public function insertIntoData($value): void
    {
        $this->county = Csrf::sanitizeString($value['county']);
        $this->country = Csrf::sanitizeString($value['country']);
        $this->town = Csrf::sanitizeString($value['town']);
        $this->description = Csrf::sanitizeString($value['description']);
        $this->address = Csrf::sanitizeString($value['address']);
        $this->image = Csrf::sanitizeString($value['image']);
        $this->thumbnail = Csrf::sanitizeString($value['thumbnail']);
        $this->latitude = Csrf::sanitizeString($value['latitude']);
        $this->longitude = Csrf::sanitizeString($value['longitude']);
        $this->num_bedrooms = Csrf::sanitizeString($value['num_bedrooms']);
        $this->num_bathrooms = Csrf::sanitizeString($value['num_bathrooms']);
        $this->price = Csrf::sanitizeString($value['price']);
        $this->property_type =  $value['property_type'];
        $this->type = Csrf::sanitizeString($value['type']);
        $this->save();
    }

    /**
     * @param $search
     * @return mixed
     */
    public function search($search)
    {
        $search = "%" . Csrf::sanitizeString($search) . "%";
        return $this::where('address', 'LIKE', $search)
            ->where('deleted', null)
            ->orWhere('price', 'LIKE', $search)
            ->orWhere('num_bedrooms', 'LIKE', $search)
            ->orWhere('num_bathrooms', 'LIKE', $search)
            ->get();
    }

    /**
     * @param $pageNo
     * @return mixed
     */
    public function editContent($pageNo)
    {
        return $this::where('id', $pageNo)->where('deleted', null)->first();
    }

    /**
     * @param $value
     * @return string
     */
    public function updateData($value)
    {
        $data = $this::where('id', $value['id'])->where('deleted', null)->first();
        if(empty(json_decode($data, true))){
            return "Sorry this data id does not exist";
        }

        if(!empty($value['county'])){
            $data->county = Csrf::sanitizeString($value['county']);
        }
        if(!empty($value['country'])) {
            $data->country = Csrf::sanitizeString($value['country']);
        }
        if(!empty($value['town'])) {
            $data->town = Csrf::sanitizeString($value['town']);
        }
        if(!empty($value['description'])) {
            $data->description = Csrf::sanitizeString($value['description']);
        }
        if(!empty($value['address'])) {
            $data->address = Csrf::sanitizeString($value['address']);
        }
        if(!empty($value['image'])) {
            $data->image = Csrf::sanitizeString($value['image']);
        }
        if(!empty($value['thumbnail'])) {
            $data->thumbnail = Csrf::sanitizeString($value['thumbnail']);
        }
        if(!empty($value['latitude'])) {
            $data->latitude = Csrf::sanitizeString($value['latitude']);
        }
        if(!empty($value['longitude'])) {
            $data->longitude = Csrf::sanitizeString($value['longitude']);
        }
        if(!empty($value['num_bedrooms'])) {
            $data->num_bedrooms = Csrf::sanitizeString($value['num_bedrooms']);
        }
        if(!empty($value['num_bathrooms'])) {
            $data->num_bathrooms = Csrf::sanitizeString($value['num_bathrooms']);
        }
        if(!empty($value['price'])) {
            $data->price = Csrf::sanitizeString($value['price']);
        }
        if(!empty($value['property_type'])) {
            $data->property_type = $value['property_type'];
        }
        if(!empty($value['type'])) {
            $data->type = Csrf::sanitizeString($value['type']);
        }
        $data->save();

        return "Data updated successfully";
    }

    /**
     * @param array $value
     * @return false|void
     */
    public function deleteData(array $value)
    {
        $data = $this::where('id', $value['id'])->first();
        if(!empty(json_decode($data, true))) {
            $data->deleted = true;
            $data->date_deleted = date('Y-m-d H:i:s');
            $data->save();
        }

    }


}
