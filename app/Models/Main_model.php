<?php
namespace App\Models;
 
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
  
class Main_model extends Model
{
  
      
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
    }

      
  
    public function getStates()
    {
        $this->db->table('states');
        $query=$this->db->table('states')->get();
        return $query->getResult();
    } 
 
    public function getCities($postData)
    {
        // $postData['state_id']
        $this->db->table('cities');
        $query = $this->db->table('cities')->where('state_id',$postData['state_id'])->get()->getResultArray();
      
        return $query;
    }
 
  
}