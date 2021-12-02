<?php
class MasterProdWeld extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterProdWeld_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('MProdWelding')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
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
$this->template->display('MasterProdWeld/index',$d); }

function ListProduct1(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct',$data); }
function ListProduct2(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct2',$data); }
function ListProduct3(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct3',$data); }
function ListProduct4(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct4',$data); }
 function ListProduct5(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct5',$data); }
function ListProduct6(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct6',$data); }
function ListProduct7(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct7',$data); }
function ListProduct8(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct8',$data); }
function ListProduct9(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct9',$data); }
function ListProduct10(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct10',$data); }
function ListProduct11(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct11',$data); }
function ListProduct12(){
 $DB=$this->MasterProdWeld_model->ListProduct();
 $data['List']=$DB->result();
 $this->load->view('MasterProdWeld/ListProduct12',$data); }

public function Save(){
 $up['PartNo'] = $this->input->post('PartNo');
 $up['PartName'] = $this->input->post('PartName');
 $up['IDCust'] = $this->input->post('IDCust');
 $up['IDProject'] = $this->input->post('IDProject');
 $up['Price'] = $this->input->post('Price');
 $up['Min'] = $this->input->post('Min');
 $up['Max'] = $this->input->post('Max');
 $up['StockFG'] = $this->input->post('StockFG');
 $up['StockWip'] = $this->input->post('StockWip');
 $up['PcsPerday'] = $this->input->post('PcsPerday');
 $up['IsActive'] = $this->input->post('IsActive');
 $up['IsWelding'] = '1' ;
 $up['CP1']   = $this->input->post('CP1');
 $up['CP2']   = $this->input->post('CP2');
 $up['CP3']   = $this->input->post('CP3');
 $up['CP4']   = $this->input->post('CP4');
 $up['CP5']   = $this->input->post('CP5');
 $up['CP6']   = $this->input->post('CP6');
 $up['CP7']   = $this->input->post('CP7');
 $up['CP8']   = $this->input->post('CP8');
 $up['CP9']   = $this->input->post('CP9');
 $up['CP10']  = $this->input->post('CP10');
 $up['CP11']  = $this->input->post('CP11');
 $up['CP12']  = $this->input->post('CP12');
 $up['MasterBy'] = '3' ;
 $id['PartNo'] = $this->input->post('PartNo');
 $id['PartName'] = $this->input->post('PartName');
 $id['IDCust'] = $this->input->post('IDCust');
 $id['IDProject'] = $this->input->post('IDProject');
 $id['CP1']   = $this->input->post('CP1');
 $up['MasterBy'] = '3' ;
 $id['IsDelete'] = 'X';
 $id2['RegID'] = $this->input->post('ItemID');
 $RegID = $this->input->post('ItemID');
 
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
 echo 'Update Gagal !!!'; }   }   }

 

public function ListProduct(){
 $id = $this->input->post('id');
 $data['TotalItem'] = $this->app_model->ItemMWelding('1',$id) ;
 $DB =$this->MasterProdWeld_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterProdWeld/master_list',$data); }
    
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