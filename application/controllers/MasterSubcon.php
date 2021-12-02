<?php
class MasterSubcon extends CI_Controller{
 function __construct()
 {
    parent::__construct();
    $this->load->model(array('app_model'));
    $this->load->library(array('form_validation','template'));
    $cek = $this->Role_Model->MSJ();
    if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
    elseif(empty($cek)){ redirect('welcome'); }
    date_default_timezone_set('Asia/Jakarta');
 }
 
 function index()
 {
    $d = array();
    $d['title']="Home";
    $text = "SELECT * FROM Q01_MProduct WHERE IsStoreRoom=1 ORDER BY PartNo DESC" ;
    $d['MListStoreRoom'] = $this->app_model->manualQuery($text);
    $text2 = "SELECT * FROM M_Category WHERE GroupBy='GA' ";
    $d['l_nama_category'] = $this->app_model->manualQuery($text2);
    $text3 = "SELECT * FROM M_Unit";
    $d['l_unit_name'] = $this->app_model->manualQuery($text3);
    $text4 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
    $d['l_MDetailStatus'] = $this->app_model->manualQuery($text4);
    
    //Time SERVER,
    $DocDate = date('d-m-Y');
    $d['DocDateReport_2'] = date('d-m-Y');
    $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
    $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
    $d['DocDateReport_2'] = $DocDate ;
    $this->template->display('MasterSubcon/index',$d);
 }
 
 public function ListProduct()
 {
    $id = $this->input->post('id');
    $where = ($this->session->userdata('SysID')!= '1') ? " AND UpdateBy='".$this->session->userdata('SysID')."'" : " AND 1=1";
    $sql = "SELECT RegID FROM M_Product WHERE IsSubcon='1' AND IsActive='1' $where";
    $data['TotalItem'] = $this->app_model->dbQuery($sql)->num_rows();
    
    $sql = "SELECT * FROM Q01_MProduct WHERE IsSubcon=1 $where ORDER BY PartName ASC";
    $DB =$this->app_model->dbQuery($sql);
    $data['list']=$DB->result();
    
    $this->load->view('MasterSubcon/master_list',$data);
 }
 
 function mssql_escape($str)
 {
    if(get_magic_quotes_gpc())
    {
        $str= stripslashes($str);
    }
    return str_replace("'", '"', $str);
 }
 
 public function Save()
 {
    //$data = $this->input->post();    
    //echo"<pre>";
    //print_r($data);
    //echo"</pre>";
    $ItemID = intval($this->input->post('ItemID'));
    $d['PartName'] = $this->mssql_escape($this->input->post('PartName'));
    $d['PartNo'] = $this->input->post('PartNo');
    $d['Spec1'] = $this->input->post('Spec');
    $d['Spec2'] = $this->input->post('Spec');
    $d['IDUnit'] = $this->input->post('IDUnit');
    $d['IsActive'] = $this->input->post('IsActive');
    $d['IsSubcon'] = '1';
    $d['UpdateBy'] = $this->session->userdata('SysID');
    
    $cek = $this->app_model->dbQuery("SELECT * FROM M_Product WHERE (PartName = '".$d['PartName']."' AND PartNo = '".$d['PartNo']."') AND IsSubcon = '1' AND UpdateBy='".$this->session->userdata('SysID')."'")->num_rows();
    if($ItemID > 0)
    {
        $this->app_model->updateData("M_Product",$d,array('RegID'=>$ItemID));
        echo "Update Sukses";
    }
    else
    {
        $ok = $this->app_model->insertData("M_Product",$d);
        if($ok)
        {
            echo "Save Sukses";
        } 
        else
        {
            echo "Save Gagal Hubungi ICT";
        }
    }
 }
 
 public function GetInfoProduct()
 {
    $data = array();
    $PartName = $this->input->post('PartName');
    $PartNo = $this->input->post('PartNo');
    
    if($PartName!='')
        $sql = "SELECT * FROM M_Product WHERE PartName = '$PartName' AND IsSubcon = '1'";
    else if($PartNo!='')
        $sql = "SELECT * FROM M_Product WHERE PartNo = '$PartNo' AND IsSubcon = '1'";
    
    $cek = $this->app_model->dbQuery($sql)->num_rows();
    if($cek > 0)
    {
        $data['status'] = '1';
        $data['msg'] = "Product Name Sudah ada";
    }
    echo json_encode($data);
    //echo $sql;
 }
 
 public function Hapus_Product()
 {
    $up['IsDelete'] = "O" ;
    $id_d['RegID'] = $this->input->post('ItemID'); 
    $data = $this->app_model->getSelectedData("M_Product",$id_d);
    if($data->num_rows()>0){
        $this->app_model->updateData("M_Product",$up,$id_d);
        echo 'Data berhasil dihapus bro' ;
    } else{        
        echo 'Gagal Menghapus bro';		
    }
 }
 
}
    