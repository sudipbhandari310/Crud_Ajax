<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CarModel extends CI_controller{

   public function __construct(){
parent::__construct();

    
    }

    
    public function index(){
        $this->load->model('Car_model');
       $rows=  $this->Car_model->all();
       $sdata['rows']=$rows;
      $this->load->view('car_model/list',$sdata);
    }




    public function showCreateForm(){
     $html= $this->load->view('car_model/create','',true);
     $response['html']=$html;
    echo json_encode($response);

    }


 public function saveModel(){


    $this->load->model('Car_model');
    $this->load->library('form_validation');
     $this->form_validation->set_rules('name','Name','required');
     $this->form_validation->set_rules('color','Color','required');
     $this->form_validation->set_rules('price','Price','required');
    

   if($this->form_validation->run() == true){
//save entries to  db
        
$data=array();
$data['name']=$this->input->post('name');
$data['price']=$this->input->post('price');
$data['transmission']=$this->input->post('transmission');
$data['color']=$this->input->post('color');
$data['created_at']=date('Y-m-d H:i:s');
$id=$this->Car_model->create($data);


$row=$this->Car_model->getRow($id);
$vData['row'] = $row; 
$rowHtml= $this->load->view('car_row',$vData,true);


$response['row']=$rowHtml;


$response['status']=1;
$response['message']="<div class=\"alert alert-success\">Record saved successfully</div>";

    }else{
        //throw error msg
        $response['status']=0;
        $response['name']=strip_tags(form_error('name'));
        $response['color']=strip_tags(form_error('color'));
        $response['price']=strip_tags(form_error('price'));

    }
    echo json_encode($response);

    }
//this method will return the edit form like create




public function getCarModel($id){
   
$this->load->model('Car_model');
$row=$this->Car_model->getRow($id);
 $data['row']=  $row;
 $html= $this->load->view('car_model/edit.php',$data,true);
$response['html']= $html;
 echo json_encode($response);
 //var_dump($response);

   }

   function updateModal(){
  
    $this->load->model('Car_model');
    $id=$this->input->post('id');

    $data=array();
$data['name']=$this->input->post('name');
$data['price']=$this->input->post('price');
$data['transmission']=$this->input->post('transmission');
$data['color']=$this->input->post('color');
$data['created_at']=date('Y-m-d H:i:s');

var_dump($data);
    
    $row=$this->Car_model->update($id, $data);
    var_dump($row);

    // if(empty($row)){
    //   $response['msg']="record not found";
    //   $response['status']=100;
    //  echo json_encode($response);
    //  exit;

   
    $this->load->library('form_validation');
     $this->form_validation->set_rules('name','Name','required');
     $this->form_validation->set_rules('color','Color','required');
     $this->form_validation->set_rules('price','Price','required');
    

   if($this->form_validation->run() == true){
//update entries to  db.
        
$data=array();
$data['name']=$this->input->post('name');
$data['price']=$this->input->post('price');
$data['transmission']=$this->input->post('transmission');
$data['color']=$this->input->post('color');
$data['updated_at']=date('Y-m-d H:i:s');
$id=$this->Car_model->update($id,$data);


$row=$this->Car_model->getRow($id);
$response['row']=$row;


$response['status']=1;
$response['message']="<div class=\"alert alert-success\">Record updated successfully</div>";

    }else{
        //throw error msg
        $response['status']=0;
        $response['name']=strip_tags(form_error('name'));
        $response['color']=strip_tags(form_error('color'));
        $response['price']=strip_tags(form_error('price'));

    }
    echo json_encode($response);

    }
   

   

    
 function deleteModel($id){
    $this->load->model('Car_model');
    $row=$this->Car_model->getRow($id);
    if(empty($row)){
        $response['msg']= "Either record deleted or not found in db ";
        $response['status']=0;
       echo json_encode($response);
        exit;
       }
       else{
        $this->Car_model->delete($id);
        $response['msg']= "Record has been deleted successfully ";
        $response['status']= 1;
       echo json_encode($response);
       }
 }
   
}