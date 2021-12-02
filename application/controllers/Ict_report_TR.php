<?php
class Ict_report_TR extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Ict_report_TR_model','app_model'));
        $this->load->library(array('form_validation','template'));
        $cek = $this->Role_Model->TrcICT();
        if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
        elseif(empty($cek)){ redirect('welcome'); }
    }
    /**{{}}**/
    function index()
    {
        $d['title']="Home";
        $text2 = "SELECT * FROM M_Category WHERE GroupBy='ICT' ORDER BY id DESC" ;
        $d['MListCategory'] = $this->app_model->manualQuery($text2); 
        
        $text3 = "SELECT * FROM M_customer ";
        $d['l_cust'] = $this->app_model->manualQuery($text3);
        
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');
        $DocDate	            = date('d-m-Y');
        $d['DocDateReport_2']= date('d-m-Y');
        $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
        $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
        $d['DocDateReport_2']= $DocDate ;
        
        $this->template->display('Ict_report_TR/index',$d); 
    }
    /**{{}}**/
    function MasterList()
    {
        $DB = $this->Ict_report_TR_model->MasterList();
        $data['MListProduct']=$DB->result();
        //echo"<pre>";
        //print_r($data);
        //echo"</pre>";
        $this->load->view('Ict_report_TR/master_list',$data); 
    } 
    /**{{}}**/
    function ReadReport()
    {
        $IDCategory = $this->input->post('IDCategory');
        $part_no = $this->input->post('part_no');
        $spec = $this->input->post('spec');
        
        $d['judul']="Store Room Stock";
        $d['tgl_1'] = $this->input->post('tgl_1');
        $d['tgl_2']  = $this->input->post('tgl_2');
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');	
        $d['tgl_2_a'] = date('m') ;
        $d['tgl_2_b']  = date('Y');
        
        $DB =$this->Ict_report_TR_model->transaction_detail_report($IDCategory,$part_no,$spec);
        $d['list']=$DB->result();
        
        //echo"<pre>";
        //print_r($d);
        //echo"</pre>";
        
        //$d['IN_R'] = 'tes';
        $this->load->view('Ict_report_TR/ViewReport',$d);
    } 
    /**{{}}**/
    public function ExportReport()
    {
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');
        $d['judul']="";
        $d['tgl_1'] = $this->uri->segment(3);
        $d['tgl_2']  = $this->uri->segment(4);
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
        $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
        $IDCategory = $this->uri->segment(5);
        $part_no = $this->uri->segment(7);
        $spec = $this->uri->segment(6);
        $per = date('Y-m');
        $tgl = $this->app_model->tgl_indo($per);
        $d['periode'] = $tgl ;
        $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);	
        $DB =$this->Ict_report_TR_model->transaction_detail_report($IDCategory,$part_no,$spec);
        $d['list']=$DB->result();
        $d['num'] = $DB->num_rows();
        $this->load->view('Ict_report_TR/ExportListReport',$d); 
    }
    /**{{}}**/ 
    
    public function ReadStockCard()
    {
        $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
        $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');
        $tgl3	= date('d-m-Y');
        $d['tgl_1'] = $this->input->post('tgl1');
        $d['tgl_2']  = $this->input->post('tgl2');
        $d['tgl_3']  = $tgl3 ;
        $ItemID = $this->input->post('ItemID');
        $DB =$this->Ict_report_TR_model->ReadStockCard($tgl1,$tgl2,$ItemID);
        $d['list']=$DB->result();
        $d['num'] = $DB->num_rows();
        $this->load->view('Ict_report_TR/ViewStockCard',$d); 
    }    
    /**{{}}**/      
    
    function UpdateBalance()
    {
        $ItemID = $this->input->post('ItemID');
        //$data['ItemID'] = $ItemID;
        $data['StockFG'] = $this->input->post('val');
        $data['StockWip'] = $this->input->post('val');
        $Stock_OLD = $this->input->post('stock');
        
        $cek = $this->app_model->updateData("M_Product",$data,array('RegID'=>$ItemID));
        
        $stok = $this->app_model->db_get_one("SELECT StockWip FROM M_Product WHERE RegID='".$ItemID."'");
        
        if($Stock_OLD == $stok)
        {
            if($cek)
            {
                echo $this->input->post('val');
            }
            else
            {
                
                echo $stok;
            }            
        }
        else 
        {
            echo $stok;
        }

        //echo"<pre>";
        //print_r($data);
        //echo"</pre>";
    }
}    