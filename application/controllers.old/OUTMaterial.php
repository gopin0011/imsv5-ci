<?php
class OUTMaterial extends CI_Controller{
    
function __construct(){
 parent::__construct();
 $this->load->model(array('OUTMaterial_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('TrcMaterial')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
 $MasterList=$this->OUTMaterial_model->MasterList();
 $d['MListProduct'] = $MasterList->result(); 
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
 $text2 = "SELECT * FROM M_Partner WHERE Category='RM' ORDER BY id DESC" ;
 $d['MListPartner'] = $this->app_model->manualQuery($text2); 
 $text3 = "SELECT * FROM M_customer ";
 $d['l_cust'] = $this->app_model->manualQuery($text3);
        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;

$this->template->display('OUTMaterial/index',$d); }
    
function MasterList(){
 $DB=$this->OUTMaterial_model->MasterList();
 $data['MListProduct']=$DB->result();
 $this->load->view('OUTMaterial/master_list',$data); }    
    
function List_Material(){
 $DB=$this->OUTMaterial_model->List_Material();
 $data['list']=$DB->result();
 $this->load->view('OUTMaterial/ListMaterial',$data); }
    
function TransactionList(){
 $DB=$this->OUTMaterial_model->transaction_list();
 $data['list']=$DB->result();
 $this->load->view('OUTMaterial/TransactionList',$data); }

function DataDetailMatIn(){
 $id = $this->input->post('kode');
 $DB =$this->OUTMaterial_model->transaction_detail($id);
 $data['list']=$DB->result();
 $this->load->view('OUTMaterial/DetailMatIn',$data); }
    
function DataDetailMatIn2(){
 $id = $this->input->post('kode');
 $DB =$this->OUTMaterial_model->transaction_detail($id);
 $data['list']=$DB->result();
 $this->load->view('OUTMaterial/DetailMatIn2',$data); }
     
public function DetailPrint(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $text = "SELECT * FROM QTH_RawMaterial WHERE DocNum='$id'";
 $data = $this->app_model->manualQuery($text);
 if($data->num_rows() > 0){
 foreach($data->result() as $db){
 $d['DocNum']	= $id;
 $d['DocDate']	= $this->app_model->tgl_indo($db->DocDate); }
 }else{
 $d['DocNum'] =$id;
 $d['DocDate'] ='';
 } 
 $DB =$this->OUTMaterial_model->transaction_detail($id);
 $d['data']=$DB->result();					
 $this->load->view('OUTMaterial/PrintMaterialIn',$d);   }
             
public function DetailPrint2(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $id2 = $this->uri->segment(4);
 $text = "SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$id'";
 $data = $this->app_model->manualQuery($text);
 if($data->num_rows() > 0){
 foreach($data->result() as $db){
 $d['DocNum']	= $id;
 $d['DocDate']	= $this->app_model->tgl_indo($db->DocDate); }
 }else{
 $d['DocNum'] =$id;
 $d['DocDate'] ='';
 } 
 $DB =$this->OUTMaterial_model->transaction_detail_2($id);
 $d['data']=$DB->result();					
 $this->load->view('OUTMaterial/PrintMaterialIn',$d);   }
    
public function PrintList(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $text = "SELECT * FROM QTH_RawMaterial WHERE DocNum='$id'";
 $data2 = $this->app_model->manualQuery($text);
 if($data2->num_rows() > 0){
 foreach($data2->result() as $db){
 $d['DocNum']	= $id;
 $d['DocDate']	= $this->app_model->tgl_str($db->DocDate);
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= $db->CreateBy ; }
 }else{
 $d['DocNum']		='';
 $d['DocDate']	='';
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= ''; } 
 $DB =$this->OUTMaterial_model->transaction_detail($id);
 $d['data']=$DB->result();
 $d['num'] = $DB->num_rows();					
 $this->load->view('OUTMaterial/PrintList',$d);     }
    
public function PrintList2(){
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $PartNo = $this->uri->segment(6);
 $d['judul'] = "";
 $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
 $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($tgl1).' - '.$this->app_model->tgl_str($tgl2);
 if($IDCust!='semua'){ $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
 $d['IDCust'] = "Semua Customer"; }
 $d['ItemID'] = $this->uri->segment(7);           
 $DB = $this->OUTMaterial_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo);
 $d['data']=$DB->result(); 
 $d['num'] = $DB->num_rows();                
 $this->load->view('OUTMaterial/PrintList2',$d); }
      
public function ReadReport(){
 $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
 $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
 $IDCust = $this->input->post('IDCust2');
 $PartNo = $this->input->post('PartNo2');          
 $DB = $this->OUTMaterial_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo);
 $d['list']=$DB->result();              
 $this->load->view('OUTMaterial/transaction_detail_report',$d); }
    
public function ExportReport(){
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $PartNo = $this->uri->segment(6);
 $d['judul'] = "";
 $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
 $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($tgl1).' - '.$this->app_model->tgl_str($tgl2);
 if($IDCust!='semua'){
 $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
 $d['IDCust'] = "All Customer"; }
 $d['ItemID'] = $this->uri->segment(6);       
 $DB = $this->OUTMaterial_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo);
 $d['data']= $DB->result(); 
 $d['num'] = $DB->num_rows();                
 $this->load->view('OUTMaterial/ExportListReport',$d); }
    
public function SimpanMaterialIn() {
 $Header['DocNum']          = $this->input->post('DocNum');
 $Header['DocDate']         = $this->app_model->tgl_sql($this->input->post('DocDate'));
 $Header['DocTime']         = $this->input->post('CreateTime');
 $Header['CreateBy']        = $this->session->userdata('RegID') ;
 $Header['CreateDate']      = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Header['HideH']           = md5($this->input->post('DocNum')) ;
 $Header['IDTrcType']       = '200';
 $Detail['CreateBy']             = $this->session->userdata('RegID') ;
 $Detail['DocNum']               = $this->input->post('DocNum') ;
 $Detail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
 $Detail['HideH'] = md5($this->input->post('DocNum')) ;
 $Detail['HideD'] = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
 $Detail['DocDate']              = $this->app_model->tgl_sql($this->input->post('DocDate'));
 $Detail['DocTime']              = $this->input->post('CreateTime');
 $Detail['CreateDate']           = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Detail['ItemID']               = $this->input->post('ItemID') ;
 $Detail['ItemIDExt']               = $this->input->post('ItemIDExt') ;
 $Detail['QtyMat']               = $this->input->post('QtyMat') ;
 $Detail['QtyPcs']               = $this->input->post('QtyPcs') ;
 $Detail['NGMatSheet']               = $this->input->post('NGMat') ;
 $Detail['BalMat']               = $this->input->post('BalMatAf') ;
 $Detail['BalPcs']               = $this->input->post('BalPcsAf') ;
 $Detail['SourceDocNum']         = $this->input->post('DocNumExt') ;   
 $Detail['PcsPerSheet']          = $this->input->post('PcsPerSheet') ;
 $Detail['PcsPerKg']             = $this->input->post('PcsPerKg') ;  
 $Detail4['BalMat']   = $this->input->post('BalMatSourceAf') ;
 $Detail4['BalPcs']   = $this->input->post('BalPcsSourceAf') ;
 $Detail4['CanEdit']  = 0 ;           
 $IndexDetail4['DocNumDetail']       = $this->input->post('DocNumExt') ;
 $IndexHeader['DocNum']               = $this->input->post('DocNum');
 $IndexHeader['CreateBy']             = $this->session->userdata('RegID') ;
 $IndexHeader2['DocNum']               = $this->input->post('DocNum');
 $IndexDetail['DocNum']               = $this->input->post('DocNum');
 $IndexDetail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
 $IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
 $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ;
 $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
 $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader);
 if($data->num_rows()>0){
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{
 $this->app_model->insertData("TD_RawMaterial",$Detail); 
 $this->app_model->updateData("TD_RawMaterial",$Detail4,$IndexDetail4);
 echo 'Tambah data Sukses' ;
 }	}else{
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail3);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_RawMaterial",$Detail,$IndexDetail3);
 $this->app_model->updateData("TD_RawMaterial",$Detail4,$IndexDetail4);
 echo 'Data berhasil diupdate' ;
 }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ;}
 } }else{ 
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader2);
 if($data->num_rows()>0){
 echo 'Silahkan Login Menggunakan User Data !!!' ;
 }else{
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{ 
 $this->app_model->insertData("TH_RawMaterial",$Header);
 $this->app_model->insertData("TD_RawMaterial",$Detail); 
 $this->app_model->updateData("TD_RawMaterial",$Detail4,$IndexDetail4);
 echo 'Simpan data Sukses' ; }  }
 }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ; } } 	  }
       
       
public function Hapus_Detail(){
 //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate = $this->app_model->tgl_sql(date('d-m-Y'));
 $up['QtyMat']       = "0" ;
 $up['QtyPcs']       = "0" ;
 $up['BalMat']       = "0" ;
 $up['BalPcs']       = "0" ;
 $up['Amount']       = "0" ;
 $up['IsDelete']     = "O" ;
 $up['CreateBy']     = $this->session->userdata('RegID');
 $up['DocDate']      = $DocDate ;
 $up2['BalMat'] = $this->input->post('QtyMatDelete') ;
 $up2['BalPcs'] = $this->input->post('QtyPcsDelete') ; 
 $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete');
 $id_d['CreateBy'] = $this->session->userdata('RegID');
 $id_d2['DocNumDetail'] = $this->input->post('DocNum_ExtDelete');
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_RawMaterial",$up,$id_d);
 $this->app_model->updateData("TD_RawMaterial",$up2,$id_d2);
 echo 'Data berhasil d hapus bro' ;
 }else{        
 echo 'Anda bukan User Data';		
 } }
    
    

function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
    
function bikin_barcode($kode){
$this->load->library('zend');
$this->zend->load('Zend/Barcode');
Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
}       
       
}