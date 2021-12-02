<?php class MasterAsset_model extends CI_Model{
    
function MasterList($LocationIDView,$DeptIDView){ 
 $where = "WHERE IsActive=1" ;
 if(empty($DeptIDView)){
 if($LocationIDView!='All'){
 $where .= "AND LocationID='$LocationIDView'" ; }else{
 $where .= "";
 } }else{
 if($LocationIDView!='All'){
 $where .= "AND id_dept='$DeptIDView' AND LocationID='$LocationIDView'";  
 }else{
 $where .= "AND id_dept='$DeptIDView'";   
 }  }
 return $this->db->query("SELECT * FROM QMaster_Asset $where ORDER BY SysID DESC"); }

function MasterList2($ID_Dept){ 
 return $this->db->query("SELECT * FROM QMaster_Asset WHERE IsActive=1 AND id_dept='$ID_Dept' ORDER BY SysID DESC"); }
 
function AvatarView($id){
 $this->db->where("ItemID",$id);
 return $this->db->get("M_Asset"); }

function MasterListPartner(){ 
 return $this->db->query("SELECT * FROM M_Partner ORDER BY id DESC"); }  
 
function PrintLabel($id){ 
 $this->db->where("ItemID",$id);
 return $this->db->get("QMaster_Asset"); } 
      
}