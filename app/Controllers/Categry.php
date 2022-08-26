<?php

namespace App\Database\Migrations;

namespace App\Controllers;

use App\Models\Categry as category;
use App\Models\Main_model;
use CodeIgniter\I18n\Time;

class Categry extends BaseController
{

    public function  __construct()
    {
        helper(['form', 'url']);

    }

    public function index()
    {
        helper(['form', 'url']);
        $this->Main_model = new Main_model();
        $data['countries'] = $this->Main_model->getStates();
        return view('Category/add_category',$data);
    }

 

    public function store_form()
    {
        $userModel = new category();

        $response = [];
        $validation = \Config\Services::validation();
        $rules = [
            'username' => ['label' => 'username ', 'rules' => 'required|trim|min_length[2]|max_length[50]'],
        ];
        $datetime = new Time('now');
       $imageuploadtime =  $datetime->format('u');

        // print_r($set);
        // // echo $set;
        // die;

        // print_r($_REQUEST['username']);
        // die;

        if ($this->validate($rules)) {

            $file = $this->request->getFile("Categoryimage");
            $profile_image = $file->getName();
            $file_type = $file->getClientMimeType();
            $valid_file_types = array("image/png", "image/jpeg", "image/jpg");

            if (empty($profile_image)) {
                $response['success'] = 0;
                $response['validation_message'] = ["Categoryimage" => "The Media field is required."];
                return json_encode($response);
            }
            if ($file->move('uploads/category', strtotime("now") . $profile_image)) {
            } else {
                $response['success'] = 0;
                $response['validation_message'] = ["Categoryimage" => "Media not upload successfully."];
                return json_encode($response);
            }
            $language=implode(',',$this->request->getVar('languages'));
        

            $data = [
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('Email'),
                'contact' => $this->request->getVar('Contact'),
                'state_id' => $this->request->getVar('state_id'),
                'city_id' => $this->request->getVar('city_id'),
                'languages' => $language,
                'category_image' => "category/" . strtotime("now") . $profile_image,
                'status' => "1",
                'created_date' => $datetime,

            ];

            if ($userModel->save($data)) {
                $response['success'] = 1;
                $response['message'] = "Category create successfully.";
            } else {
                $response['success'] = 0;
                $response['message'] = "Something bad happen category not crested.";
            }
        } else {
            $response['success'] = 0;
            $error_message = "";
            $response['validation_message'] = $this->validator->getErrors();
        }
        return json_encode($response);
    }

    public function show()
    {
        $params = array();
        return view('Category/categry_list', $params);
    }

    public function show_list_catgery()
    {
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search_value = $_REQUEST['search']['value'];
        $category_modal = new category();
        $data = $category_modal->get_category_list($search_value, $params['draw'], $start, $length);
        echo json_encode($data);
    }

 

    public function delete()
    {
        $id = $_REQUEST['id'];
     
        $category_model = new category();
        $data = [
            "status" => 0,
        ];
         $response = $category_model->data_delete('tbl_category', ["id" => $id], $data);

   
         return $response;
    }

    public function view($id = null)
    {

        $userModel = new category();
        $data['category_info'] = $userModel->get_single_data('tbl_category', ['tbl_category.id' => $id], ["username","email","contact","states.name as state_id","cities.name as city_id","languages","category_image"], "Category data found.");
        return view('Category/view_singel_category', $data);
    }
}
