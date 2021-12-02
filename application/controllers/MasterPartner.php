<?php
class MasterPartner extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterPartner_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MPartner() ;
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 
$this->template->display('MasterPartner/index',$d); }

public function Save(){
 $up['partner_code'] = $this->input->post('partner_code');
 $up['partner_name'] = $this->input->post('partner_name'); 
 $up['address'] = $this->input->post('address');
 $up['telp'] = $this->input->post('telp');
 $id['partner_code'] = $this->input->post('partner_code');
 $id['partner_name'] = $this->input->post('partner_name'); 
 $id['IsDelete'] = 'X';
 $RegID = $this->input->post('id');    
 $id2['id']       = $this->input->post('id');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Partner",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Partner",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Partner",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Partner",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; } } }

public function ListProduct(){
 $data['TotalItem'] = $this->app_model->TotalCust() ;
 $DB =$this->MasterPartner_model->MasterList();
 $data['list']=$DB->result();
 $this->load->view('MasterPartner/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete'] = "O" ;
 $id_d['id'] = $this->input->post('id'); 
 $data = $this->app_model->getSelectedData("M_Partner",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Partner",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}