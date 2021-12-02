<?php
class MasterUser extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterUser_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('MUser')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM M_Level ORDER BY id_level DESC" ;
 $d['l_MLevel'] = $this->app_model->manualQuery($text);
 $text2 = "SELECT * FROM M_Department ORDER BY id DESC" ;
 $d['l_MDept'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text3);
$this->template->display('MasterUser/index',$d); }

public function Save(){
 $pwd = $this->input->post('pwd4');
 $pwd2 = "strongID";
 $up['username']          = $this->input->post('username');
 $up['nama_lengkap']      = $this->input->post('nama_lengkap');
 $up['level']             = $this->input->post('level');
 $up['id_dept']           = $this->input->post('id_dept');
 $up['blokir']            = $this->input->post('IsActive');
 $up['password']          = md5($pwd) ;
 $up['password2']          = md5($pwd2) ;
 $up['MUser']             = $this->input->post('MUser') ;
 $up['MUserIMS']          = $this->input->post('MUserIMS') ;  
 $up['MUserTR']           = $this->input->post('MUserTR') ; 
 $up['MProdMaterial']     = $this->input->post('MProdMaterial') ; 
 $up['MProdStamping']     = $this->input->post('MProdStamping') ; 
 $up['MProdWelding']      = $this->input->post('MProdWelding') ; 
 $up['MProdDelivery']     = $this->input->post('MProdDelivery') ; 
 $up['MProdStoreRoom']    = $this->input->post('MProdStoreRoom') ; 
 $up['MProdICT']          = $this->input->post('MProdICT') ;
 $up['MProdGA']           = $this->input->post('MProdGA') ;
 $up['MPartner']            = $this->input->post('MPartner') ; 
 $up['MCategory']            = $this->input->post('MCategory') ; 
 $up['MUnit']            = $this->input->post('MUnit') ; 
 $up['MCust']            = $this->input->post('MCust') ;  
 $up['MProduct']            = $this->input->post('MProduct') ; 
 $up['MUtility']            = $this->input->post('MUtility') ;  
 $up['TrcMaterial']            = $this->input->post('TrcMaterial') ; 
 $up['TrcStamping']            = $this->input->post('TrcStamping') ; 
 $up['TrcWelding']            = $this->input->post('TrcWelding') ; 
 $up['TrcWH']            = $this->input->post('TrcWH') ; 
 $up['TrcStoreRoom']            = $this->input->post('TrcStoreRoom') ; 
 $up['TrcGA']            = $this->input->post('TrcGA') ; 
 $up['TrcSony']            = $this->input->post('TrcSony') ; 
 $up['TrcProduction']            = $this->input->post('TrcProduction') ; 
 $up['TrcICT']            = $this->input->post('TrcICT') ; 
 $up['TrcWIP']            = $this->input->post('TrcWIP') ;
 $up['CanEditDoc']            = $this->input->post('CanEditDoc') ; 
 $up['CanEditMaster']            = $this->input->post('CanEditMaster') ;
 $up['CanEditDocAdmin']            = $this->input->post('CanEditDocAdmin') ;
 $up2['username']               = $this->input->post('username');
 $up2['nama_lengkap']         = $this->input->post('nama_lengkap');
 $up2['level']               = $this->input->post('level');
 $up2['id_dept']            = $this->input->post('id_dept');
 $up2['blokir']            = $this->input->post('IsActive');
 $up2['MUser']            = $this->input->post('MUser') ; 
 $up2['MUserTR']            = $this->input->post('MUserTR') ; 
 $up2['MProdMaterial']            = $this->input->post('MProdMaterial') ; 
 $up2['MProdStamping']            = $this->input->post('MProdStamping') ; 
 $up2['MProdWelding']            = $this->input->post('MProdWelding') ; 
 $up2['MProdDelivery']            = $this->input->post('MProdDelivery') ; 
 $up2['MProdStoreRoom']            = $this->input->post('MProdStoreRoom') ; 
 $up2['MProdICT']            = $this->input->post('MProdICT') ;
 $up2['MProdGA']            = $this->input->post('MProdGA') ;
 $up2['MProdMTNM']            = $this->input->post('MProdMTNM') ;
 $up2['MProdMTNT']            = $this->input->post('MProdMTNT') ;
 $up2['MPartner']            = $this->input->post('MPartner') ; 
 $up2['MCategory']            = $this->input->post('MCategory') ; 
 $up2['MUnit']            = $this->input->post('MUnit') ; 
 $up2['MCust']            = $this->input->post('MCust') ;
 $up2['MProduct']            = $this->input->post('MProduct') ; 
 $up2['MUtility']            = $this->input->post('MUtility') ;  
 $up2['TrcMaterial']            = $this->input->post('TrcMaterial') ; 
 $up2['TrcStamping']            = $this->input->post('TrcStamping') ; 
 $up2['TrcWelding']            = $this->input->post('TrcWelding') ; 
 $up2['TrcWH']            = $this->input->post('TrcWH') ; 
 $up2['TrcStoreRoom']            = $this->input->post('TrcStoreRoom') ; 
 $up2['TrcGA']            = $this->input->post('TrcGA') ; 
 $up2['TrcMTC']            = $this->input->post('TrcMTC') ;
 $up2['TrcGA']            = $this->input->post('TrcGA') ; 
 $up2['TrcMTC']            = $this->input->post('TrcMTC') ; 
 $up2['TrcMTNM']            = $this->input->post('TrcMTNM') ;
 $up2['TrcMTNT']            = $this->input->post('TrcMTNT') ; 
 $up2['TrcICT']            = $this->input->post('TrcICT') ; 
 $up2['TrcWIP']            = $this->input->post('TrcWIP') ; 
 $up2['CanEditDoc']            = $this->input->post('CanEditDoc') ;
 $up2['CanEditMaster']            = $this->input->post('CanEditMaster') ; 
 $up2['CanEditDocAdmin']            = $this->input->post('CanEditDocAdmin') ;
 $id['RegID']               = $this->input->post('RegID'); 
 $id2['username']               = $this->input->post('username');
 $id2['nama_lengkap']         = $this->input->post('nama_lengkap');
 $id2['level']               = $this->input->post('level');
 $id2['id_dept']            = $this->input->post('id_dept');
 $id2['blokir']            = $this->input->post('IsActive');
 $id2['IsDelete']         = 'X';
 $RegID               = $this->input->post('RegID'); 
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_User",$id2);
 if($data->num_rows()>0){
 echo 'Data Sudah Ada';
 }else{
 $this->app_model->insertData("M_User",$up);
 echo 'Data berhasil ditambah bro';	 } }else{
 $data = $this->app_model->getSelectedData("M_User",$id);
 if($data->num_rows()>0){
 if(empty($pwd)){
 $this->app_model->updateData("M_User",$up2,$id);
 echo 'Edit Data Sukses';
 }else{
 $this->app_model->updateData("M_User",$up,$id);
 echo 'Edit Data Sukses'; }
 }else{
 echo 'Data Tidak Ada';	 }  }  }

public function ListProduct(){
 $id = $this->input->post('id');
 $data['TotalItem'] = $this->app_model->TotalUser('1',$id) ;
 $DB =$this->MasterUser_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterUser/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete']           = "O" ;
 $id_d['RegID']            = $this->input->post('RegID'); 
 $data = $this->app_model->getSelectedData("M_User",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_User",$up,$id_d);
 echo 'Data berhasil d hapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; }	}
        
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}