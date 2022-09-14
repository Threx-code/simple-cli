<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Controllers;

use App\Models\TableData;
use App\Requests\SearchRequest;
use App\Validation\Csrf;
use Exception;

class IndexController extends Controller
{
    public function index()
    {
        if (isset($_GET['page_no'], $_GET['token']) && !empty($_GET['page_no'])) {
            $page_no = $this->sanitize($_GET['page_no']);
        //&& $this->checkToken($_GET['token'])
        } else {
            $page_no = 1;
        }
        $tableData = new  TableData();
        $csrf = $this->csrf();
        $this->model('TableData');
        $per_page = $tableData->perPage();

        $offset = $tableData->offset($page_no);
        $previous_page = $tableData->previousPage($page_no);
        $next_page = $tableData->nextPage($page_no);
        $adjacent = $tableData->adjacent();

        $data = TableData::orderby('id', 'desc')->offset($offset)->limit($per_page)->get();
        $total_records = TableData::count('id');

        $total_no_of_pages = ceil($total_records / $per_page);
        $second_last = $total_no_of_pages - 1;

        return $this->view(
            "homepage",
            compact('csrf', 'data', 'page_no', 'previous_page', 'next_page', 'total_no_of_pages')
        );
    }

    /**
     * @throws Exception
     */
    public function search()
    {

        $request = $_REQUEST;
        $req = get_defined_vars();
        $validator = (new SearchRequest($req['request']))->validate();
        if (!empty($validator)) {
            echo json_encode($validator);
            exit;
        }
        if ($this->checkToken($request['token'])) {
            $search = Csrf::sanitizeString($request['search']) ;
            $data = (new TableData())->search($search);
            return $this->view("search",
                compact('data')
            );
        }
    }


    /**
     * @throws Exception
     */
    public function autocomplete()
    {
        $request = $_REQUEST;
        $response = [];
        $search = Csrf::sanitizeString($request['term']) ;
        $data = (new TableData())->search($search);
        if(!empty($data)){
            foreach($data as $key => $value){
                $response[] = $value['address'];
                $response[] = $value['price'];
                $response[] = $value['num_bathrooms'];
                $response[] = $value['num_bedrooms'];
            }
        }
        return json_encode($response);
    }
}
