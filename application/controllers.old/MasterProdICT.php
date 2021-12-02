<?php
class MasterProdICT extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('MasterProdICT_model','app_model'));
        $this->load->library(array('form_validation','template'));
        $cek = $this->session->userdata('MProdICT')=='1';
        if(!$this->session->userdata('username')){ redirect('welcome');  } 
        elseif(empty($cek)){ redirect('welcome'); }
    }
    
    function index()
    {
        $d['title']="Home";
        $text = "SELECT * FROM Q01_MProduct WHERE IsICT=1 ORDER BY PartNo DESC" ;
        $d['MListStoreRoom'] = $this->app_model->manualQuery($text);
        $text2 = "SELECT * FROM M_Category WHERE GroupBy='ICT' ";
        $d['l_nama_category'] = $this->app_model->manualQuery($text2);
        $text3 = "SELECT * FROM M_Unit";
        $d['l_unit_name'] = $this->app_model->manualQuery($text3);
        $text4 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
        $d['l_MDetailStatus'] = $this->app_model->manualQuery($text4);
        
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');
        $DocDate = date('d-m-Y');
        $d['DocDateReport_2'] = date('d-m-Y');
        $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
        $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
        $d['DocDateReport_2'] = $DocDate ;
        $this->template->display('MasterProdICT/index',$d);       
    }
    
    function ListProduct()
    {
        $id = $this->input->post('id');
        $data['TotalItem'] = $this->app_model->ItemMICT('1',$id) ;
        $DB =$this->MasterProdICT_model->MasterList($id);
        $data['list']=$DB->result();
        $this->load->view('MasterProdICT/master_list',$data);        
    }

    public function Save()
    {
        $up['PartName'] = $this->input->post('PartName');
        $up['Spec2'] = $this->input->post('Spec');
        $up['Price'] = $this->input->post('Price');
        $up['Min']   = $this->input->post('Min');
        $up['Max']   = $this->input->post('Max');
        $up['StockFG'] = $this->input->post('StockFG');
        $up['StockWip'] = $this->input->post('StockFG');
        $up['IsActive'] = $this->input->post('IsActive');
        $up['IDCategory'] = $this->input->post('IDCategory');
        $up['IDUnit'] = $this->input->post('IDUnit');
        $up['IsICT'] = '1' ;
        $up['IsDelete'] = 'X' ;
        $up['MasterBy'] = '9' ;
        $id['PartName'] = $this->input->post('PartName');
        $id['IsActive'] = $this->input->post('IsActive');
        $id['IDCategory'] = $this->input->post('IDCategory');
        $id['IDUnit'] = $this->input->post('IDUnit');
        $id['Spec2'] = $this->input->post('Spec');
        $id['IsICT'] = '1' ;
        $id['MasterBy'] = '9' ;
        $id['IsDelete'] = 'X';
        $id2['RegID'] = $this->input->post('ItemID');
        $RegID = $this->input->post('ItemID');
        if(empty($RegID))
        {
            $data = $this->app_model->getSelectedData("M_Product",$id);
            if($data->num_rows()>0)
            {
                echo 'Data Sudah ada bro';
            }
            else
            {
                $this->app_model->insertData("M_Product",$up);
                echo 'Data berhasil ditambah bro'; 
            }
        }
        else
        {
            $data = $this->app_model->getSelectedData("M_Product",$id2);
            if($data->num_rows()>0)
            {
                $this->app_model->updateData("M_Product",$up,$id2);
                echo 'Data berhasil diupdate bro';
            }
            else
            {
                echo 'Update Gagal !!!'; 
            }    
        }  
    }

    public function Hapus_Product()
    {
        $up['IsDelete'] = "O" ;
        $id_d['RegID'] = $this->input->post('ItemID'); 
        $data = $this->app_model->getSelectedData("M_Product",$id_d);
        if($data->num_rows()>0)
        {
            $this->app_model->updateData("M_Product",$up,$id_d);
            echo 'Data berhasil dihapus bro' ;
        }
        else
        {        
            echo 'Gagal Menghapus bro';		
        } 	
    }
 
     
}