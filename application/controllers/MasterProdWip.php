<?php
class MasterProdWip extends CI_Controller{

function __construct(){
parent::__construct();
$this->load->model(array('MasterProdWip_model','app_model'));
$this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MProdWip();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM Q01_MProduct WHERE IsStamping=1 ORDER BY IDCust DESC" ;
 $d['MListMaterial'] = $this->app_model->manualQuery($text);
 $text5 = "SELECT * FROM M_MaterialType";
 $d['l_MaterialType'] = $this->app_model->manualQuery($text5);
 $text2 = "SELECT * FROM M_Customer ORDER BY Code ASC";
 $d['l_MCust'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_Project ORDER BY ProjectName ASC";
 $d['l_MProject'] = $this->app_model->manualQuery($text3);
 $text4 = "SELECT * FROM M_MaterialType ";
 $d['l_MMaterialType'] = $this->app_model->manualQuery($text4);
 $text6 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text6);
            
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate = date('d-m-Y');
$d['DocDateReport_2'] = date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2'] = $DocDate ;
$this->template->display('MasterProdWip/index',$d); }

public function ConectingBomList(){
 $id = $this->input->post('id');
 $DB = $this->MasterProdWip_model->ConectingBomList($id);
 $d['list']=$DB->result();
 $this->load->view('MasterProdWip/ConectingBomList',$d); }

public function DeleteConecting(){
 $Head['SysID'] = $this->input->post('SysID');
 $SysID = $this->input->post('SysID');
 $data = $this->app_model->getSelectedData("CMProduct_BOM",$Head);
 if($data->num_rows()>0){
 $this->MasterProdWip_model->DeleteConecting($SysID);
 }}

public function SelectBOM(){
 $Detail['ItemID_Product'] = $this->input->post('ItemID');
 $Detail['ItemID_BOM'] = $this->input->post('SysID');
 $Detail['PartTypeID'] = $this->input->post('PartTypeID');
 $Head['ItemID_Product'] = $this->input->post('ItemID');
 $Head['ItemID_BOM'] = $this->input->post('SysID');
 $Head['PartTypeID'] = $this->input->post('PartTypeID');
 $data = $this->app_model->getSelectedData("CMProduct_BOM",$Head);
 if($data->num_rows()>0){
 }else{ $this->app_model->insertData("CMProduct_BOM",$Detail);  }  }
  
function ListProduct1(){
 //$DB=$this->MasterProdWip_model->ListProduct();
 $DB = $this->app_model->dbQuery("SELECT * FROM BOM2 WHERE IsActiveDetail=1 AND IsDeleteDetail=0 AND PartType LIKE '%PC%' ORDER BY SysID ASC");
 $data['List']=$DB->result();
 $this->load->view('MasterProdWip/ListProduct',$data); }

public function Save(){
 $up['MaterialNum'] = $this->input->post('RegID');
 $up['PartNo'] = $this->input->post('PartNo');
 $up['PartName'] = $this->input->post('PartName');
 $up['IDCust'] = $this->input->post('IDCust');
 $up['IDProject'] = $this->input->post('IDProject');
 $up['PcsPerDay'] = $this->input->post('PcsPerDay');
 $up['Price'] = $this->input->post('Price');
 $up['Min'] = $this->input->post('Min');
 $up['Max'] = $this->input->post('Max');
 $up['StockFG']              = $this->input->post('StockFG');
 $up['StockWip']             = $this->input->post('StockWip');
 $up['IsActive']             = $this->input->post('IsActive');
 $up['IsWIP']           = '1' ;
 $up['MasterBy']           = '2' ;
 $id['PartNo']               = $this->input->post('PartNo');
 $id['PartName']             = $this->input->post('PartName');
 $id['IDCust']               = $this->input->post('IDCust');
 $id['IsWIP']           = '1' ;
 $id['MasterBy']           = '2' ;
 $id['MaterialNum']          = $this->input->post('RegID');
 $id['IsDelete']         = 'X';
 $id2['RegID']       = $this->input->post('ItemID');
 $RegID               = $this->input->post('ItemID');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Product",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Product",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Product",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Product",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; }     }   }

 

public function ListProduct(){
 $id = $this->input->post('id');
 $data['TotalItemStamping'] = $this->app_model->ItemMStamping('1',$id) ;
 $DB =$this->MasterProdWip_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterProdWip/master_list',$data); }
    


public function Hapus_Product(){
 $up['IsDelete'] = "O" ;
 $id_d['RegID'] = $this->input->post('ItemID'); 
 $data = $this->app_model->getSelectedData("M_Product",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Product",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro';		
 } 	}
    

                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}