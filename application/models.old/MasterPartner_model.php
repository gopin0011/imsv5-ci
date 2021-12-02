<?php class MasterPartner_model extends CI_Model{
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM M_Partner WHERE IsDelete='X' ORDER BY partner_code ASC"); }
    
    
}