<?php class MasterProdICT_model extends CI_Model{
    function MasterList($id)
    { 
        $CategoryID = "" ;
        if($id!='All'){$CategoryID .= "AND IDCategory='$id'" ; }else{$CategoryID .= "" ; } 
        return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsICT=1 $CategoryID ORDER BY PartName ASC"); 
    }
}