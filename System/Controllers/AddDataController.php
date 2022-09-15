<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Controllers;

use App\Models\TableData;
use App\Requests\AddDataRequest;
use App\Requests\EditViewRequest;
use App\Requests\UpdateDataRequest;
use App\Services\ImageIntervention;
use App\Validation\Csrf;
use Exception;

class AddDataController extends Controller
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $csrf = $this->csrf();
        return $this->view("add-data", compact('csrf'));
    }


    /**
     * @return void
     * @throws Exception
     */
    public function store(): void
    {
        $request = $_REQUEST;
        $req = get_defined_vars();
        $validator = (new AddDataRequest($req['request']))->validate();
        if (!empty($validator)) {
            echo json_encode($validator);
            exit;
        }

        if ($this->checkToken($request['token'])) {
            if (isset($_FILES['image']['name'])) {
                $imageName = random_bytes(32);
                $imageName = substr($imageName, 0, 4);
                $imageName = hash("ripemd128", $imageName);
                $data['imageType'] = $_FILES['image']['type'];
                $data['imageURL'] = "System/assets/images/" . $imageName . ".jpg";
                $data['tempName'] = $_FILES['image']['tmp_name'];
                $imageIntervention = new ImageIntervention;
                $thumbnail = $imageIntervention->thumbnail($data);
                $fullImage = $imageIntervention->fullImage($data);
            }else{
                echo json_encode(["Error"=> "Please select an Image to upload"]);
                exit;
            }
            $value = [];
            $value['county'] = $request['county'];
            $value['country'] = $request['country'];
            $value['town'] = $request['town'];
            $value['description'] =  $request['description'];
            $value['image'] = $fullImage;
            $value['thumbnail'] = $thumbnail;
            $value['latitude'] = $request['latitude'];
            $value['longitude'] = $request['longitude'];
            $value['num_bedrooms'] = $request['num_bedrooms'];
            $value['num_bathrooms'] = $request['num_bathrooms'];
            $value['price'] = $request['price'];
            $value['address'] = $request['address'];
            $value['property_type'] = json_encode(["type" => $request['type'], "description" => $request['description']]);
            $value['type'] = $request['type'];
            (new TableData())->insertIntoData($value);
        }
    }

    public function edit()
    {
        $request = $_REQUEST;
        $req = get_defined_vars();
        $validator = (new EditViewRequest($req['request']))->validate();
        if (!empty($validator)) {
            echo json_encode($validator);
            exit;
        }

        if ($this->checkToken($request['token'])) {
            $pageNo = Csrf::sanitizeString($request['item_no']) ;
            $data = (new TableData())->editContent($pageNo);
            $data = json_decode($data, true);

            return $this->view("edit-content", compact('data')
            );
        }
    }


    public function update()
    {
        $request = $_REQUEST;
        $req = get_defined_vars();
        $validator = (new UpdateDataRequest($req['request']))->validate();
        if (!empty($validator)) {
            echo json_encode($validator);
            exit;
        }

        if ($this->checkToken($request['token'])) {
            if (!empty($_FILES['image']['name'])) {
                $imageName = random_bytes(32);
                $imageName = substr($imageName, 0, 4);
                $imageName = hash("ripemd128", $imageName);
                $data['imageType'] = $_FILES['image']['type'];
                $data['imageURL'] = "System/assets/images/" . $imageName . ".jpg";
                $data['tempName'] = $_FILES['image']['tmp_name'];
                $imageIntervention = new ImageIntervention;
                $thumbnail = $imageIntervention->thumbnail($data);
                $fullImage = $imageIntervention->fullImage($data);
            }
            $value = [];
            $value['id'] = $request['id'];
            $value['county'] = $request['county'];
            $value['country'] = $request['country'];
            $value['town'] = $request['town'];
            $value['description'] =  $request['description'];
            $value['image'] = $fullImage ?? null;
            $value['thumbnail'] = $thumbnail ?? null;
            $value['latitude'] = $request['latitude'];
            $value['longitude'] = $request['longitude'];
            $value['num_bedrooms'] = $request['num_bedrooms'];
            $value['num_bathrooms'] = $request['num_bathrooms'];
            $value['price'] = $request['price'];
            $value['address'] = $request['address'];
            $value['property_type'] = json_encode(["type" => $request['type'], "description" => $request['description']]);
            $value['type'] = $request['type'];

            $response = (new TableData())->updateData($value);

            echo $response;
        }

    }
}
