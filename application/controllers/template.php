<?php
class template extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('app_user'));
 $this->load->library(array('template'));
 if(!$this->session->userdata('username')){ redirect('welcome'); } }
    
function index(){
 $d['title']="Home";
 }
 
 $this->template->display('home/index',$d); }
 
         
}