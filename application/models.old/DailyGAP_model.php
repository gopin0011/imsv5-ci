<?php class DailyGAP_model extends CI_Model{
    
function MasterList($id){ 
 return $this->db->query("SELECT * FROM Q_DailyEmail_GAP WHERE DelivDate = '$id' ORDER BY PartnerCode ASC"); }
    
    
}