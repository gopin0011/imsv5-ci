<?php
class ref_mail extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model(array('app_model'));
    }
    
    public function confirm_surat_jalan()
    {
        $RegID = $this->uri->segment(3);
        $status = 1;
        $d['StatusConfirm'] = $status;
        $d['IsConfirm'] = ($status == '1') ? '1' : '0';
        //$d['ConfirmBy'] = $this->session->userdata('SysID');
        $d['ConfirmDate'] = date('Y-m-d');
        $d['ConfirmTime'] = date('H:i:s');
        
        $ok = $this->app_model->updateData("TH_SuratJalan",$d,array('RegID'=>$RegID));
        $data['RegID'] = $RegID;
        
        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";
        //echo'Update Sukses';
        die('<script>alert(\'Confirm Sukses\');window.close();</script>');
    }
}    