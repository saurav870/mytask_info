<?php

namespace App\Controllers;

use App\Models\Main_model;
use App\Models\Product_model;


class Home extends BaseController
{

    public function index() {
          
        helper(['form', 'url']);
        $this->Main_model = new Main_model();
        $data['countries'] = $this->Main_model->getCountries();
        return view('dropdown-view', $data);
    }
 
    public function getStates() {
        
        $this->Main_model = new Main_model();
  
        $postData = array(
            'state_id' => $this->request->getPost('state_id'),
        );
  
        $data = $this->Main_model->getStates($postData);
  
        echo json_encode($data);
    }
  
    public function getCities() {
  


        $this->Main_model = new Main_model();
  
        $postData = array(
            'state_id' => $this->request->getPost('state_id'),
        );
       
  
        $data = $this->Main_model->getCities($postData);
        
        echo json_encode($data);
    }    

   
}
