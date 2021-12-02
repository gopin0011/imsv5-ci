<?php class MasterUserTR_model extends CI_Model{
    
function MasterList($id){ 
 $DeptID = "" ;
 if($id!='All'){$DeptID .= "AND id_dept='$id'" ; }else{$DeptID .= "" ; }
 return $this->db->query("SELECT * FROM IMSUser WHERE IsStoreRoom='1' $DeptID ORDER BY nama_lengkap ASC"); }
    
    
}