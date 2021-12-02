<?php class Ict_report_TR_model extends CI_Model{
    private $table="D_Comment";

    function transaction_detail_report($IDCategory,$part_no,$spec)
    {
        $where = "";
        if(empty($part_no))
        {
            if($IDCategory!='semua')
            {
                if(!empty($spec))
                {
                    $where .= "WHERE IDCategory='$IDCategory' AND Spec2 LIKE '%$spec%'";
                }
                else
                {
                    $where .= "WHERE IDCategory='$IDCategory' ";
                }
            }
            else
            {
                if(!empty($spec))
                {
                    $where .= "WHERE Spec2 LIKE '%$spec%'";
                } 
        }
        }
        else
        {
            if($IDCategory!='semua')
            {
                if(!empty($spec))
                {
                    $where .= "WHERE PartName LIKE '%$part_no%' AND IDCategory='$IDCategory' AND Spec2 LIKE '%$spec%'";
                }
                else
                {
                    $where .= "WHERE PartName LIKE '%$part_no%' AND IDCategory='$IDCategory'";
                }
            }
            else
            {
                if(!empty($spec))
                {
                    $where .= "WHERE PartName LIKE '%$part_no%' AND Spec2 LIKE '%$spec%'";
                }
                else
                { 
                    $where .= "WHERE PartName LIKE '%$part_no%'" ; 
                } 
            }  
        } 
        
        if($where == '') $where .= "WHERE IsDelete = 'X' ";
        else $where .= " AND IsDelete = 'X' ";
        
        $text = "SELECT * FROM StockICTTR $where ORDER BY PartNo ASC ";
        
        //echo "<pre>";
        //print_r($text);
        //echo "</pre>";
        return $this->db->query($text);  
    }   
    /**{{}}**/ 
    
    function MasterList()
    {
        $sql = "SELECT a.*, c.unit 
                FROM ListMaterialOut a 
                LEFT JOIN M_Product b ON b.RegID = a.ItemID
                LEFT JOIN M_Unit c ON c.id = b.IDUnit
                WHERE a.IDTrcType=1010 
                ORDER BY RegID ASC";
        return $this->db->query($sql); 
    }

    function ReadStockCard($tgl1,$tgl2,$ItemID)
    {  
        $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2'";     
        if(!empty($ItemID)){
        $where .= "AND ItemID='$ItemID' "; }
        $text = "SELECT* FROM SCToolRoom $where ORDER BY DocDate, DocTime ASC ";
        return $this->db->query($text); 
    }
    /**{{}}**/ 
 
}    