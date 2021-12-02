<?php
class MasterUnit extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterUnit_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MUnit();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 
$this->template->display('MasterUnit/index',$d); }

public function Save(){
 $up['code']               = $this->input->post('code');
 $up['unit']         = $this->input->post('unit'); 
 $id['code']               = $this->input->post('code');
 $id['unit']         = $this->input->post('unit');
 $id['IsDelete']         = 'X';     
 $RegID               = $this->input->post('id');    
 $id2['id']       = $this->input->post('id');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Unit",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Unit",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Unit",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Unit",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; }  }   }

public function ListProduct(){
 $data['TotalItem'] = $this->app_model->TotalCust() ;
 $DB =$this->MasterUnit_model->MasterList();
 $data['list']=$DB->result();
 $this->load->view('MasterUnit/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete'] = "O" ;
 $id_d['id'] = $this->input->post('id'); 
 $data = $this->app_model->getSelectedData("M_Unit",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Unit",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}