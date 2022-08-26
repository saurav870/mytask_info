<?php

namespace App\Models;

use App\Models\Panel_Model;
use CodeIgniter\Model;
use Exception;

class Categry extends Model
{
    protected $table  = 'tbl_category';

    protected $allowedFields    = ['id', 'username', 'email', 'contact', 'state_id', 'city_id','category_image','languages','created_date','status'];

    public function get_category_list($search_value, $draw, $start, $length)
    {

        $response = [];

        $arrayList = [];
        $message = "";
        if($message){
            $message = "Data Found";

        }
        try{
            if (!empty($search_value)) {


            $total_count = $this->db->query("SELECT id,username,email,contact ,created_date,state_id,city_id,languages from tbl_category where status= 1 and  (username like '%" . $search_value  . "%')  ORDER BY tbl_category.created_date DESC limit $start, $length")->getResult();

            $data = $this->db->query("SELECT id,username,email,contact ,created_date,state_id,city_id,languages from tbl_category where status= 1 and  (username like '%" . $search_value  . "%')  ORDER BY tbl_category.created_date DESC limit $start, $length")->getResult();
            // echo $this->db->getLastQuery();
            // print_r($data);
            // die;

        } else {

            $total_count = $this->db->query("SELECT * from tbl_category where status = 1")->getResult();

            $data = $this->db->query("SELECT id,username,email,contact ,created_date,state_id,city_id,languages from tbl_category where status= 1    ORDER BY tbl_category.created_date DESC  limit $start, $length")->getResult();
     

        }
        $arrayList = [];
       $s_no = !empty($start)?$start:1;
        foreach ($data as $row) {


            $action = '
            <a  href="view_categry/'.$row->id . '" class="btn btn-sm btn-info">
                <i class="fe-edit"></i> View</a>
           
              <button  name="deleteButton" data-id="' . $row->id . '" class="btn btn-sm btn-danger">
             <i class="fe-trash"></i> Delete</button> ';
         
            $arrayList[] = [
                $s_no,

                $row->username,
                $row->email,
                $row->contact,
                $row->languages,
                $row->state_id,
                $row->city_id,
                $action
            ];
            $s_no++;
        }

        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $arrayList   // total data array
        );
        $response = $output;
        $response['status'] = 1;
        $response['message'] = $message;
    }catch (Exception $e){
        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => $arrayList   // total data array
        );
        $response = $output;
        $response['status'] = 0;
        $response['message'] = $message;

    }
        return $output;
    }


    public function data_delete($tabelname, $where, $data)
    {
        $response = [];

        try {
            $result =  $this->db
                ->table($tabelname)
                ->where($where)
                ->set($data)
                ->update();

            if ($result) {
                $response['status'] = 1;
                $response['message'] = " delete successfully.";
            } else {
                $response['status'] = 0;
                $response['message'] = " not deleted.Please try again";
            }
        } catch (Exception $e) {
            $response['status'] = 0;
            $response['message'] = $e;
        }

        return $response;
    }



    public function get_single_data($tabelname, $where, $data, $message = "")
    {
        $response = [];
        if (empty($message)) {
            $message = "Data found";
        }
        try {
            $result =  $this->db
                ->table($tabelname)
                ->select($data)
                ->where($where)
                ->join('states', 'states.id = tbl_category.state_id')
                ->join('cities', 'cities.id = tbl_category.city_id')
                ->get()->getResultArray();

                // echo $this->db->getLastQuery();
                // die;

            if (count($result) > 0) {
                $response['status'] = 1;
                $response['message'] = $message;
                $response['data'] = $result;
            } else {
                $response['status'] = 0;
                $response['message'] = "Data not found.";
            }
        } catch (Exception $e) {
            $response['status'] = 0;
            $response['message'] = $e;
        }
        return $response;
    }





 
}
