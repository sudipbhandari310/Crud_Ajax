<?php
defined('BASEPATH') or exit('No direct script access allowed');

 class Car_model extends CI_Model{
  
    public function create($data){
    $this->db->insert('car_models', $data);
     return $id=$this->db->insert_id();

    }
//this method will return all datas from table
    public function all(){
       $result= $this->db->order_by('id','ASC')->get('car_models')->result_array();
       return $result;
    }

    

 public function getRow($id){
  //selects * from car_models where id = $id
$this->db->where('id',$id);
$row =  $this->db->get('car_models')->row_array();
return $row;


    } 



  public function update($id, $data){
      $this->db->where('id',$id);
      $query = $this->db->update('car_models', $data);
      return $query;
    

  }


  public function delete($id){
    $this->db->where('id',$id);
    $this->db->delete('car_models');

  }
  
 }