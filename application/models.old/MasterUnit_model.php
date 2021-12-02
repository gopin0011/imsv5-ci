<?php class MasterUnit_model extends CI_Model{
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM M_Unit WHERE IsDelete='X' ORDER BY Code ASC"); }
    
    
}