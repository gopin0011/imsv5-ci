<?php
class MigrasiPanel extends CI_Controller{
    
 function __construct()
 {
    parent::__construct();
    $this->load->model(array('app_model'));
    $this->load->library(array('form_validation'));
    /*
    if(!$this->session->userdata('UserName'))
    { 
        redirect('welcome');  
    } 
    elseif(empty($cek))
    { 
        redirect('welcome'); 
    }
    
    */
    //var_dump($this->session->userdata('UserName'));
    if($this->session->userdata('UserName')!='Root')
    { 
        redirect('welcome');
    }
    date_default_timezone_set('Asia/Jakarta');
 }
 
 public function index()
 {
    $data = array();
    $this->load->view('Admin/index',$data);
 }
 
 public function MasterBom()
 {
    $data = array();
    $this->load->view('Admin/index',$data);
 }

 
} 