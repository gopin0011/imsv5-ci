<?php class DailyGAP_model extends CI_Model{
    
function MasterList($id){ 
 return $this->db->query("SELECT * FROM QDailyEmail_GAP_New WHERE DelivDate = '$id' ORDER BY PartnerCode ASC"); }
    
    
}