<?php
class Material_report extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('Material_report_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->TrcMaterialUp();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}

function index(){
 $d['title']="Home";
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
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

$this->template->display('Material_report/index',$d); }
    
function MasterList(){
$id = $this->input->post('kode');    
$DB = $this->Material_report_model->MasterList($id);
$data['MListProduct']=$DB->result();
$this->load->view('Material_report/master_list',$data); } 

function MasterList2(){
$DB = $this->Material_report_model->MasterList2();
$data['MListProduct2']=$DB->result();
$this->load->view('Material_report/master_list2',$data); }    
    
    
public function ReadReport2(){
$d['DocDateReport_1'] = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
$d['DocDateReport_2'] = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
$IDCust = $this->input->post('IDCust');
$ItemID = $this->input->post('ItemID');
$SpecRM = $this->input->post('SpecRM'); 
$cek = $this->Material_report_model->transaction_detail_report($IDCust,$ItemID,$SpecRM);
$d['list']=$cek->result(); 
$this->load->view('Material_report/ViewReport2',$d); }

public function ExportReport2(){

$d['judul']="Raw Material Stock";
$d['DocDateReport_1'] = $this->app_model->tgl_sql($this->uri->segment(3));
$d['DocDateReport_2']  = $this->app_model->tgl_sql($this->uri->segment(4));
$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
$IDCust = $this->uri->segment(5);
$part_no = $this->uri->segment(7);
$spec = $this->uri->segment(6);
$per = date('Y-m');
$tgl = $this->app_model->tgl_indo($per);
$d['periode'] = $tgl ;
$d['filter'] = 'Tanggal '.$this->app_model->tgl_indo($tgl1).' s.d '.$this->app_model->tgl_indo($tgl2);
                      
$cek = $this->Material_report_model->transaction_detail_report($IDCust,$part_no,$spec);
$d['list']=$cek->result(); 
$d['num'] = $cek->num_rows();
$this->load->view('Material_report/ExportListReport2',$d); }

public function ExportReport1(){
$d['judul']="Raw Material Stock";
$d['DocDateReport_1'] = $this->app_model->tgl_sql($this->uri->segment(3));
$d['DocDateReport_2']  = $this->app_model->tgl_sql($this->uri->segment(4));
$tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
$ItemID =  $this->uri->segment(5); 
$d['PartNo'] = $this->uri->segment(6); 
$cek =$this->Material_report_model->transaction_detail($ItemID);
$d['list']=$cek->result();
$d['num'] = $cek->num_rows();
$this->load->view('Material_report/ExportListReport1',$d); }

function ReadReport1(){
$ItemID = $this->input->post('ItemID');
$DB = $this->Material_report_model->transaction_detail($ItemID);
$d['list']=$DB->result();
$this->load->view('Material_report/ViewReport1',$d);}  

public function ReadStockCard(){
$tgl1 = $this->app_model->tgl_sql($this->input->post('DocDateReport1'));
$tgl2 = $this->app_model->tgl_sql($this->input->post('DocDateReport2'));
$ItemID = $this->input->post('ItemID');
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$tgl3	= date('d-m-Y');
$d['tgl_1'] = $this->app_model->tgl_sql($this->input->post('DocDateReport1'));
$d['tgl_2']  = $this->app_model->tgl_sql($this->input->post('DocDateReport2'));
$d['tgl_3']  = $this->app_model->tgl_sql($tgl3) ;
$cek =$this->Material_report_model->ReadStockCard($tgl1,$tgl2,$ItemID);
$d['list']=$cek->result();
$d['num'] = $cek->num_rows();
$this->load->view('Material_report/ViewStockCard',$d); }
    
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