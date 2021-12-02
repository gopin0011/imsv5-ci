<?php
class MonitoringStockFG extends CI_Controller{

function __construct(){
parent::__construct();
$this->load->model(array('MonitoringStockFG_model','app_model'));
$this->load->library(array('form_validation','template2'));
}
    
function index(){
 $d['title']="Home";
 $text2 = "SELECT * FROM MonitoringFGListCust ORDER BY Code";
 $d['l_MCust'] = $this->app_model->manualQuery($text2);
  $d['counter'] = "32000" ;
 $d['visit_counter'] = "30" ;
$this->template2->display('MonitoringStockFG/index',$d); }

public function NextID(){
 $id = $this->input->post('id');
 $text = "SELECT * FROM MonitoringFGListCust WHERE RegID='$id'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){ 
 $data['NOMOR']= $t->NOMOR ;
 echo json_encode($data); }
 }else{
 $data['NOMOR']= '1';
 echo json_encode($data); } }

public function NextIDCust(){
 $id = $this->input->post('id');
 $text = "SELECT * FROM MonitoringFGListCust WHERE NOMOR='$id'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){ 
 $data['RegID']= $t->RegID ;
 echo json_encode($data); }
 }else{
 $data['RegID']= '24';
 echo json_encode($data); } }
            

public function ListProduct(){
 $d['judul']= "";    
 $id = $this->input->post('idXX'); 
 $total_cust = $this->app_model->total_cust_item_FG($id) ;
 $data_danger = $this->app_model->cari_percent_danger_FG($id) ;
 $data_warning = $this->app_model->cari_percent_warning_FG($id) ;
 $data_safe = $this->app_model->cari_percent_safe_FG($id) ;
 $data_warning_up = $this->app_model->cari_percent_warning_up_FG($id) ;
 $data_danger_up = $this->app_model->cari_percent_danger_up_FG($id) ;
 if($total_cust==0){
 $dangerX = 0 ; }else{ $dangerX = $data_danger / $total_cust ; }
 if($total_cust==0){
 $warningX = 0 ; }else{ $warningX = $data_warning / $total_cust ; } 
 if($total_cust==0){
 $safeX = 0 ; }else{ $safeX = $data_safe / $total_cust ; }  
 if($total_cust==0){
 $warning_upX = 0 ; }else{ $warning_upX = $data_warning_up / $total_cust ; }
 if($total_cust==0){
 $danger_upX = 0 ; }else{ $danger_upX = $data_danger_up / $total_cust ; }  
 $danger = ($dangerX) * 100 ;
 $warning = ($warningX) * 100;
 $safe = ($safeX) * 100;
 $warning_up = ($warning_upX) * 100;
 $danger_up = ($danger_upX) * 100 ;
 $danger1 = $data_danger ;
 $warning1 = $data_warning ;
 $safe1 = $data_safe ;
 $warning_up1 = $data_warning_up ;
 $danger_up1 = $data_danger_up ;
 $data['danger'] = $danger ;
 $data['warning'] = $warning ;
 $data['safe'] = $safe ;
 $data['warning_up'] = $warning_up ;
 $data['danger_up'] = $danger_up ;
 $d['danger'] = $danger ;
 $d['warning'] = $warning ;
 $d['safe'] = $safe ;
 $d['warning_up'] = $warning_up ;
 $d['danger_up'] = $danger_up ;
 $d['danger1'] = $danger1 ;
 $d['warning1'] = $warning1 ;
 $d['safe1'] = $safe1 ;
 $d['warning_up1'] = $warning_up1 ;
 $d['danger_up1'] = $danger_up1 ;
 $d['next'] = "index.php/monitor/monitor_sim_2/" ;
 $d['counter'] = "32000" ;
 $d['visit_counter'] = "30" ;
 $d['danger_legenda'] = "Stock < 1" ;
 $d['warning_legenda'] = " 1 <strong>&#8804;</strong> Stock <strong>&#60;</strong> 3" ;
 $d['safe_legenda'] = "3 <strong>&#8804;</strong> Stock <strong>&#8804;</strong> 7" ; 
 $d['warning_up_legenda'] = "7 <strong>&#60;</strong> Stock <strong>&#8804;</strong> 10" ;
 $d['danger_up_legenda'] = "Stock <strong>&#62;</strong> 10" ;
 
 $DB =$this->MonitoringStockFG_model->MasterList($id);
 $d['list']=$DB->result();
 $d['num'] = $DB->num_rows();
 
 
 $this->load->view('MonitoringStockFG/master_list',$d);
  }
  
public function ListProduct2(){
 $d['judul']= "";    
 $id = $this->input->post('id');
 
 $total_cust = $this->app_model->total_cust_item_FG($id) ;
 $data_danger = $this->app_model->cari_percent_danger_FG($id) ;
 $data_warning = $this->app_model->cari_percent_warning_FG($id) ;
 $data_safe = $this->app_model->cari_percent_safe_FG($id) ;
 $data_warning_up = $this->app_model->cari_percent_warning_up_FG($id) ;
 $data_danger_up = $this->app_model->cari_percent_danger_up_FG($id) ;
 if($total_cust==0){
 $dangerX = 0 ; }else{ $dangerX = $data_danger / $total_cust ; }
 if($total_cust==0){
 $warningX = 0 ; }else{ $warningX = $data_warning / $total_cust ; } 
 if($total_cust==0){
 $safeX = 0 ; }else{ $safeX = $data_safe / $total_cust ; }  
 if($total_cust==0){
 $warning_upX = 0 ; }else{ $warning_upX = $data_warning_up / $total_cust ; }
 if($total_cust==0){
 $danger_upX = 0 ; }else{ $danger_upX = $data_danger_up / $total_cust ; }  
 $danger = ($dangerX) * 100 ;
 $warning = ($warningX) * 100;
 $safe = ($safeX) * 100;
 $warning_up = ($warning_upX) * 100;
 $danger_up = ($danger_upX) * 100 ;
 $danger1 = $data_danger ;
 $warning1 = $data_warning ;
 $safe1 = $data_safe ;
 $warning_up1 = $data_warning_up ;
 $danger_up1 = $data_danger_up ;
 $data['danger'] = number_format($danger,2) ;
 $data['warning'] = number_format($warning,2) ;
 $data['safe'] = number_format($safe,2) ;
 $data['warning_up'] = number_format($warning_up,2) ;
 $data['danger_up'] = number_format($danger_up,2) ;

 echo json_encode($data);

  }
 
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}