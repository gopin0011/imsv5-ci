<?php
class ReportWip extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('ReportWip_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->TrcWIP();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
 
    
function index(){
 $d['title']="Home";
 $text2 = "SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 ORDER BY IDCust DESC" ;
 $d['MListMaterial'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_Project ";
 $d['l_MProject'] = $this->app_model->manualQuery($text3);
 $text = "SELECT * FROM M_CustWIP WHERE Count > 0";
 $d['l_cust'] = $this->app_model->manualQuery($text);
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = date('d-m-Y');
 $d['DocDateReport_2']= date('d-m-Y');
 $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
 $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
 $d['DocDateReport_2']= $DocDate ;
 $this->template->display('ReportWip/index',$d); }
    
function MasterList(){
 $id = $this->input->post('kode');    
 $DB = $this->ReportWip_model->MasterList($id);
 $data['MListProduct']=$DB->result();
 $this->load->view('ReportWip/master_list',$data); } 

function MasterList2(){
 $DB = $this->ReportWip_model->MasterList2();
 $data['MListProduct2']=$DB->result();
 $this->load->view('ReportWip/master_list2',$data); }    
    
public function ReadReport(){
 $d['DocDateReport_1'] = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
 $d['DocDateReport_2'] = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
            //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
 $tgl3	= date('d-m-Y');
 $d['tgl_1'] = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
 $d['tgl_2']  = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
 $d['tgl_3']  = $tgl3 ;
            
 $IDCust = $this->input->post('IDCust');
 $ItemID = $this->input->post('ItemID');
 $DB = $this->ReportWip_model->transaction_detail_report($IDCust,$ItemID);
 $d['list']=$DB->result(); 
 $this->load->view('ReportWip/ViewReport',$d); }

public function ExportReport(){
 $d['judul']="Raw Material Stock";
 $d['DocDateReport_1'] = $this->app_model->tgl_sql($this->uri->segment(3));
 $d['DocDateReport_2']  = $this->app_model->tgl_sql($this->uri->segment(4));
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $ItemID = $this->uri->segment(6);
 $per = date('Y-m');
 $tgl = $this->app_model->tgl_indo($per);
 $d['periode'] = $tgl ;
 $d['filter'] = 'Tanggal '.$this->app_model->tgl_indo($tgl1).' s.d '.$this->app_model->tgl_indo($tgl2);
                      
$DB = $this->ReportWip_model->transaction_detail_report($IDCust,$ItemID);
 $d['list']=$DB->result(); 
 $d['num'] = $DB->num_rows();
 $this->load->view('ReportWip/ExportListReport',$d); }


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
 $DB =$this->ReportWip_model->ReadStockCard($tgl1,$tgl2,$ItemID);
 $d['list']=$DB->result();
 $d['num'] = $DB->num_rows();
 $this->load->view('ReportWip/ViewStockCard',$d); }

public function Save(){
 $up['IDProject'] = $this->input->post('IDProject');
 $up['StockWIP2'] = $this->input->post('StockWIP2');
 $up['PcsPerday'] = $this->input->post('PcsPerday');
 $up['IsWIP'] = $this->input->post('IsWIP');
 $index['RegID'] = $this->input->post('ItemID');                
 $data = $this->app_model->getSelectedData("M_Product",$index);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Product",$up,$index);
 echo 'Data berhasil diupdate bro';		
 }else{
 echo 'Data tidak ada bro'; }  } 
                    
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