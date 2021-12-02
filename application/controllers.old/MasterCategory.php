<?php
class MasterCategory extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterCategory_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('MCategory')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 
$this->template->display('MasterCategory/index',$d); }

public function Save(){
 $up['code']               = $this->input->post('code');
 $up['category_name']         = $this->input->post('category_name'); 
 $up['GroupBy']         = $this->input->post('GroupBy'); 
 $id['code']               = $this->input->post('code');
 $id['category_name']         = $this->input->post('category_name');                 
 $id['IsDelete']         = 'X';     
 $RegID               = $this->input->post('id');    
 $id2['id']       = $this->input->post('id');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Category",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Category",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Category",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Category",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; }   }   }

public function ListProduct(){
 $data['TotalItem'] = $this->app_model->TotalCust() ;
 $DB =$this->MasterCategory_model->MasterList();
 $data['list']=$DB->result();
 $this->load->view('MasterCategory/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete']           = "O" ;
 $id_d['id']            = $this->input->post('id'); 
 $data = $this->app_model->getSelectedData("M_Category",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Category",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}