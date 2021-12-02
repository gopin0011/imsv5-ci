<?php class MasterUser_model extends CI_Model{
    
function MasterList($id){ 
 $DeptID = "" ;
 if($id!='All'){$DeptID .= "AND id_dept='$id'" ; }else{$DeptID .= "" ; }
 return $this->db->query("SELECT * FROM IMSUser WHERE IsStoreRoom IS NULL AND IsDelete='X' $DeptID ORDER BY nama_lengkap ASC"); }
    
    
}