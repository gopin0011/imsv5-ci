<?php
class ReportDies extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('ReportDies_model','app_model'));
 $this->load->library(array('form_validation','template','template2'));
 $cek = $this->Role_Model->TrcStamping();
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
 $text3 = "SELECT * FROM M_Customer ORDER BY CustName ASC";
 $d['l_cust'] = $this->app_model->manualQuery($text3);
        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;

$this->template->display('ReportDies/index',$d); }
    
function MasterList(){
$id = $this->input->post('kode');    
$DB = $this->ReportDies_model->MasterList($id);
$data['MListProduct']=$DB->result();
$this->load->view('ReportDies/master_list',$data); } 

    


function ReadReport1(){
 $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
 $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2')); 
 $ItemID = $this->input->post('ItemIDReport'); 
 $ProsesD = $this->input->post('ProsesD');
 $DB =$this->ReportDies_model->transaction_detail_report_1($tgl1,$tgl2,$ItemID,$ProsesD);
 $d['list']=$DB->result();
 $d['num'] = $DB->num_rows();
 $this->load->view('ReportDies/ViewReport1',$d);}

public function ReadReport2(){
$d['tgl_1'] = $this->app_model->tgl_sql($this->input->post('tgl1'));
$d['tgl_2'] = $this->app_model->tgl_sql($this->input->post('tgl2'));
            
 $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
 $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
 $ItemID = $this->input->post('ItemIDReport'); 
 $ProsesD = $this->input->post('ProsesD');
 $IDCust = $this->input->post('IDCust');

$DB = $this->ReportDies_model->transaction_detail_report_2($ItemID,$ProsesD,$IDCust);
$d['list']=$DB->result(); 
$d['num'] = $DB->num_rows();
$this->load->view('ReportDies/ViewReport2',$d); }

public function ExportReport2(){
 $d['judul']="Export Data Stroke Dies";
 $d['tgl_1'] = $this->app_model->tgl_sql($this->uri->segment(3));
 $d['tgl_2']  = $this->app_model->tgl_sql($this->uri->segment(4));
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $ProsesD = $this->uri->segment(6);
 $ItemID = $this->uri->segment(7);
 
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = date('d-m-Y');
 $d['filter'] = $DocDate ;
                      
 $DB = $this->ReportDies_model->transaction_detail_report_2($ItemID,$ProsesD,$IDCust);
 $d['list']=$DB->result(); 
 $d['num'] = $DB->num_rows();
 $this->load->view('ReportDies/ExportListReport2',$d); }

public function ExportReport1(){
$d['judul']="";
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $ItemID = $this->uri->segment(5);
 $ProsesD = $this->uri->segment(6); 
 
$d['PartNo'] = $this->app_model->CariNamaProduct($this->uri->segment(5)); 
$DB =$this->ReportDies_model->transaction_detail_report_1($tgl1,$tgl2,$ItemID,$ProsesD);
$d['list']=$DB->result();
$d['num'] = $DB->num_rows();
$this->load->view('ReportDies/ExportListReport1',$d); }


    
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