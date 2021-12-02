<?php
class OutNonSTP extends CI_Controller{
 function __construct(){
 parent::__construct();
 $this->load->model(array('OutNonSTP_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('TrcWelding')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text7 = "SELECT * FROM M_ProsesProduction WITH (NOLOCK) WHERE Category='STP' ";
 $d['M_ProsesProduction'] = $this->app_model->manualQuery($text7);
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%NON%' ";
 $d['QCCheck'] = $this->app_model->manualQuery($text5);
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
 $text2 = "SELECT * FROM M_Line WITH (NOLOCK) WHERE Category='NON STP' ";
 $d['l_MLine'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM ProsesH WITH (NOLOCK)";
 $d['l_ProsesH'] = $this->app_model->manualQuery($text3);
 $text = "SELECT * FROM Q01_MProduct WITH (NOLOCK) WHERE IsStamping=1 AND IsActive=1 ORDER BY IDCust DESC" ;
 $d['MListProduct'] = $this->app_model->manualQuery($text); 
 $text4 = "SELECT * FROM M_customer WITH (NOLOCK) ";
 $d['l_cust'] = $this->app_model->manualQuery($text4);
        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;
$this->template->display('OutNonSTP/index',$d); }

public function PrintLabel(){
 $id = $this->uri->segment(3);
 $d['judul'] = "Print Label";
 $text = "SELECT * FROM QTD_Production WHERE HideD='$id'";
 $data = $this->app_model->manualQuery($text);
 if($data->num_rows() > 0){
 foreach($data->result() as $db){
 $d['DocNum'] = $id;
 $d['DocDate'] = $this->app_model->tgl_str($db->DocDate); }
 }else{
 $d['DocNum'] =$id;
 $d['DocDate'] =''; } 
 $DB=$this->OutNonSTP_model->transaction_detail_3($id);
 $d['data']=$DB->result();				
 $this->load->view('OutNonSTP/PrintLabel',$d);     	}

public function PrintLabelNew(){
 $id = $this->uri->segment(3);
 $d['judul'] = "Print Label";
 $text = "SELECT * FROM QTD_Production WHERE HideD='$id'";
 $data = $this->app_model->manualQuery($text);
 if($data->num_rows() > 0){
 foreach($data->result() as $db){
 $d['DocNum'] = $id;
 $d['DocDate'] = $this->app_model->tgl_str($db->DocDate); }
 }else{
 $d['DocNum'] =$id;
 $d['DocDate'] =''; } 
 $DB=$this->OutNonSTP_model->transaction_detail_3($id);
 $d['data']=$DB->result();				
 $this->load->view('OutNonSTP/PrintLabelNew',$d);     	}
    
function MasterList(){
 $DB=$this->OutNonSTP_model->MasterList();
 $data['MListProduct']=$DB->result();
 $this->load->view('OutNonSTP/master_list',$data); }    

function MasterListPartner(){
 $DB=$this->OutNonSTP_model->MasterListPartner();
 $data['list']=$DB->result();
 $this->load->view('OutNonSTP/master_partner',$data); }
    
function TransactionList(){
 $DB=$this->OutNonSTP_model->transaction_list();
 $data['list']=$DB->result();
 $this->load->view('OutNonSTP/TransactionList',$data); }
    
function DataDetailMatIn(){
 $id = $this->input->post('kode');
 $DB =$this->OutNonSTP_model->transaction_detail($id);
 $data['list']=$DB->result();
 $this->load->view('OutNonSTP/DetailMatIn',$data); }
    
function DataDetailMatIn2(){
 $id = $this->input->post('kode');
 $DB =$this->OutNonSTP_model->transaction_detail($id);
 $data['list']=$DB->result();
 $this->load->view('OutNonSTP/DetailMatIn2',$data); }
 
function DataDetailMatIn3(){
 $id = $this->input->post('kode');
 $DB =$this->OutNonSTP_model->transaction_detail($id);
 $data['list']=$DB->result();
 $this->load->view('OutNonSTP/DetailMatIn3',$data); }
        

public function ReadReport(){
 $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
 $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
 $IDCust = $this->input->post('IDCust2');
 $Factory = "ALL" ;
 $PartNo = $this->input->post('PartNo2'); 
 $IDLine = $this->input->post('IDLine2');      
 $DB = $this->OutNonSTP_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$Factory,$PartNo,$IDLine);
 $d['list']=$DB->result();              
 $this->load->view('OutNonSTP/transaction_detail_report',$d); }
    
public function ExportReport(){
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $Factory = "ALL" ;
 $IDLine = $this->uri->segment(6); 
 $IDCust = $this->uri->segment(7); 
 $PartNo = $this->uri->segment(8);
 $d['judul'] = "Production Report";
 $d['filter'] = $this->app_model->tgl_indo($tgl1).' ~ '.$this->app_model->tgl_indo($tgl2);
 $d['filter2'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
 if($Factory!='ALL'){
 $d['Factory'] = $this->uri->segment(5); }else{
 $d['Factory'] = "All Factory"; } 
 if($IDLine!='ALL'){
 $d['IDLine'] = $this->app_model->CariLineName($this->uri->segment(6));}else{
 $d['IDLine'] = "All Line"; } 
 if($IDCust!='ALL'){
 $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(7));}else{
 $d['IDCust'] = "All Customer"; } 
 $d['PartNo'] = $this->uri->segment(8);     
 $DB = $this->OutNonSTP_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$Factory,$PartNo,$IDLine);
 $d['data']= $DB->result(); 
 $d['num'] = $DB->num_rows();                
 $this->load->view('OutNonSTP/ExportListReport',$d); }
 
 public function PrintReport(){
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $Factory = "ALL" ;
 $IDLine = $this->uri->segment(6); 
 $IDCust = $this->uri->segment(7); 
 $PartNo = $this->uri->segment(8);
 $d['judul'] = "Production Report"; 
 $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
 $d['filter2'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);       
 $DB = $this->OutNonSTP_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$Factory,$PartNo,$IDLine);
 $d['data']=$DB->result(); 
 $d['num'] = $DB->num_rows();                
 $this->load->view('OutNonSTP/PrintReport',$d); }
    
public function DetailPrint(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $id2 = $this->uri->segment(4);
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
 $DB =$this->OutNonSTP_model->transaction_detail($id);
 $d['data']=$DB->result();					
 $this->load->view('OutNonSTP/PrintMaterialIn',$d);   }
             
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
 $DB =$this->OutNonSTP_model->transaction_detail_2($id);
 $d['data']=$DB->result();					
 $this->load->view('OutNonSTP/PrintMaterialIn',$d);   }
            
        
public function Save(){
 $Header['DocNum'] = $this->input->post('DocNum');
 $Header['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate'));
 $Header['CreateTime'] = $this->input->post('CreateTime');
 $Header['CreateBy'] = $this->session->userdata('RegID') ;
 $Header['CreateDate'] = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Header['HideH'] = md5($this->input->post('DocNum')) ;
 $Header['ItemID'] = $this->input->post('ItemID') ;
 $Header['ProsesH'] = $this->input->post('ProsesH') ;
 $Header['IDTrcType'] = '3000'; 
 $Header2['ItemID'] = $this->input->post('ItemID') ;
 $Header2['ProsesH'] = $this->input->post('ProsesH') ;
 $Detail['CreateBy'] = $this->session->userdata('RegID') ;
 $Detail['DocNum'] = $this->input->post('DocNum') ;
 $Detail['DocNumDetail'] = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
 $Detail['HideH'] = md5($this->input->post('DocNum')) ;
 $Detail['HideD'] = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
 $Detail['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate'));
 $Detail['CreateTime'] = $this->input->post('CreateTime');
 $Detail['CreateDate'] = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Detail['ItemID'] = $this->input->post('ItemID') ;  
 $Detail['IDLine'] = $this->input->post('IDLine') ; 
 $Detail['IDLineDetail'] = $this->input->post('IDLineDetail') ; 
 $Detail['ProsesD'] = $this->input->post('ProsesD') ; 
 $Detail['ProsesH'] = $this->input->post('ProsesH') ;
 $Detail['Status'] = $this->input->post('Status') ; 
 $Detail['Qty'] = $this->input->post('Qty') ; 
 $Detail['NG'] = $this->input->post('NG') ;
 $Detail['Yield']   = $this->input->post('Total') ; 
 $Detail['QCCheck']   = $this->input->post('QCCheck') ;
 $Detail['OP1']   = $this->input->post('OP1') ;
 $Detail['OP2']   = $this->input->post('OP2') ;
 $Detail['StdPack']   = $this->input->post('StdPack') ;
 $Detail['Remark']   = $this->input->post('Remark') ; 
 $Detail['LotNo']   = $this->input->post('LotNo') ;
 $Detail['VanNo']   = $this->input->post('VanNo') ;
 $IndexHeader['DocNum'] = $this->input->post('DocNum');
 $IndexHeader['CreateBy']    = $this->session->userdata('RegID') ; 
 $IndexHeader2['DocNum'] = $this->input->post('DocNum'); 
 $IndexDetail['DocNum'] = $this->input->post('DocNum');
 $IndexDetail['DocNumDetail'] = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ; 
 $IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
 $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ; 
 $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
 $data = $this->app_model->getSelectedData("TH_Production",$IndexHeader);
 if($data->num_rows()>0){
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TD_Production",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{
 $this->app_model->insertData("TD_Production",$Detail); 
 $this->app_model->updateData("TH_Production",$Header2,$IndexHeader2);
 $this->app_model->updateData("G_DocNumMat",$Header2,$IndexHeader2); 
 echo 'Tambah data Sukses' ;
 }	}else{
 $data = $this->app_model->getSelectedData("TD_Production",$IndexDetail3);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_Production",$Detail,$IndexDetail3);
 $this->app_model->updateData("TH_Production",$Header2,$IndexHeader2);
 $this->app_model->updateData("G_DocNumMat",$Header2,$IndexHeader2); 
 echo 'Data berhasil diupdate' ;
 }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ;} }
 }else{ 
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TH_Production",$IndexHeader2);
 if($data->num_rows()>0){
 echo 'Silahkan Login Menggunakan User Data !!!' ;
 }else{
 $data = $this->app_model->getSelectedData("TD_Production",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{ 
 $this->app_model->insertData("TH_Production",$Header);
 $this->app_model->insertData("TD_Production",$Detail); 
 $this->app_model->updateData("G_DocNumMat",$Header2,$IndexHeader2); 
 $this->app_model->updateData("TH_Production",$Header2,$IndexHeader2);
 echo 'Simpan data Sukses' ; }   }
 }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ; } } }
 
public function Hapus_Transaksi(){
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate = $this->app_model->tgl_sql(date('d-m-Y'));
 $up['Qty'] = "0" ;
 $up['NG'] = "0" ;
 $up['IsDelete'] = "1" ;
 $up['CreateBy'] = $this->session->userdata('RegID');
 $up['DocDate'] = $DocDate ;
 $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete') ;
 $id_d['CreateBy'] = $this->session->userdata('RegID') ;
 $data = $this->app_model->getSelectedData("TD_Production",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_Production",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal, Anda bukan User Data'; } }
    
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