<?php class Ict_out_TR_model extends CI_Model{

    function MasterList(){
        return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsICT=1 AND IsActive=1 AND IsDelete='X' ORDER BY PartName DESC"); 
    }
    
    /**{{}}**/
    
    function MListPartner(){
        return $this->db->query("SELECT * FROM M_Partner ORDER BY id DESC");
    }    
    
    /**{{}}**/
    
    function transaction_list(){
        $limit= 50; $offset = 0;
        return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=2020 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
    }   
    
    /**{{}}**/ 
    
    function transaction_detail($id){
        return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); 
    }
    
    /**{{}}**/
    
    function transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID)
    {
        $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType='2020'" ; 
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
    
    function MasterListPic()
    {
        return $this->db->query("SELECT * FROM ListPicTR ORDER BY id DESC"); 
    }
    /**{{}}**/
     
 }