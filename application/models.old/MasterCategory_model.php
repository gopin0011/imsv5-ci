<?php class MasterCategory_model extends CI_Model{
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM M_Category WHERE IsDelete='X' ORDER BY Code ASC"); }
    
    
}