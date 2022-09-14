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


    public function search($search)
    {
        $search = "%" . Csrf::sanitizeString($search) . "%";
        return $this::where('address', 'LIKE', $search)
            ->orWhere('price', 'LIKE', $search)
            ->orWhere('num_bedrooms', 'LIKE', $search)
            ->orWhere('num_bathrooms', 'LIKE', $search)
            ->get();
    }

    public function editContent($pageNo)
    {
        return $this::where('id', $pageNo)
            ->first();
    }
}
