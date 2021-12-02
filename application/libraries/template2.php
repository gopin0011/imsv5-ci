<?php
class Template2{
    protected $_CI;
    function __construct(){
        $this->_CI=&get_instance();
    }
    
    function display($template2,$data=null){
        $data['_content']=$this->_CI->load->view($template2,$data,true);
        $data['_header2']=$this->_CI->load->view('template/header2',$data,true);
        $data['_sidebar2']=$this->_CI->load->view('template/sidebar2',$data,true);
        
        $this->_CI->load->view('/template2.php',$data);
    }
}