<?php class MasterCust_model extends CI_Model{
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM M_Customer WHERE IsDelete='X' ORDER BY Code ASC"); }
    
    
}