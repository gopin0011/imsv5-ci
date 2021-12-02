<?php class Ict_in_TR_model extends CI_Model{
	
    function MasterList(){
        return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsICT=1 AND IsActive=1 AND IsDelete='X' ORDER BY PartName DESC"); 
    }

    function MListPartner(){
        return $this->db->query("SELECT * FROM M_Partner ORDER BY id DESC");
    }

    function transaction_list(){
        $limit= 50; $offset = 0;
        return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=1010 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
    }
    
    public function InfoTambahFormTRMatIn(){ 
        $id = $this->input->post('kode');
        if(empty($id)){
            $DocNumDetail = '001'   ; 
            $DocNum = $this->app_model->DocNumMaterialINRMOther();
        }else{
            $DocNumDetail = $this->app_model->DocNumDetailMaterialINTR($id);
            $id = $this->input->post('kode');  
        }
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');		    
        $CreateDate = date('d-m-Y');
        $DocDate = date('d-m-Y');
        $CreateDateSQL = date('Y-m-d');
        $CreateTime = date ("H:i:s") ;
        $data['DocNumDetail'] = $DocNumDetail ; 
        $data['DocNum'] = $DocNum ;
        $data['CreateDate']	= $CreateDate ;
        $data['DocDate']	    = $DocDate ;
        $data['CreateTime']	= $CreateTime ;
        echo json_encode($data);
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');	
        $CreateDate	            = date('d-m-Y');
        $DocDate	            = date('d-m-Y');
        $CreateDateSQL	        = date('Y-m-d');
        $CreateTime	            = date ("H:i:s") ;
        $up['DocNum'] = $this->app_model->DocNumMaterialINRMOther() ;
        $up['CreateDate'] = $CreateDateSQL ;
        $up['DocDate'] = $CreateDateSQL ;
        $up['CreateBy'] = $this->session->userdata('RegID');
        $up['CreateTime'] = $CreateTime ;
        $id['DocNum'] = $this->app_model->DocNumMaterialINRMOther();
        $id['CreateBy'] = $this->session->userdata('RegID');
        $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
        if($data->num_rows()>0){
        }else{
            $this->app_model->insertData("G_DocNumMat",$up);
        }  
    }
    
    function transaction_detail($id){
        return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); 
    }
    
    /**{{}}**/ 
    function transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID)
    {
        $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType='1010'" ; 
        if(empty($ItemID))
        {
            if($IDCategory!='semua')
            {
                if($PartnerID!='ALL')
                {
                    $where .= "AND PartnerID='$PartnerID' AND IDCategory='$IDCategory'";
                }
                else
                {
                    $where .= "AND IDCategory='$IDCategory' ";
                }
            }
            else
            {
            if($PartnerID!='ALL')
            {
                $where .= "AND PartnerID='$PartnerID'";}
            }
        }
        else
        {
            if($IDCategory!='semua')
            {
                if($PartnerID!='ALL')
                {
                    $where .= "AND ItemID='$ItemID' AND PartnerID='$PartnerID' AND IDCategory='$IDCategory'";
                }
                else
                {
                    $where .= "AND ItemID='$ItemID' AND IDCategory='$IDCategory'";
                }
            }
            else
            {
                if($PartnerID!='ALL')
                {
                    $where .= "AND ItemID='$ItemID' AND PartnerID='$PartnerID'";
                }
                else
                { 
                    $where .= "AND ItemID='$ItemID'" ; 
                } 
            } 	 
        } 
        
        $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY RegID ASC ";
        
        return $this->db->query($text);
    }    
    /**{{}}**/    
}