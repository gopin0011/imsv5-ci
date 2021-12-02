<?php class MasterUser_model extends CI_Model{
    
function MasterList($id){ 
 $DeptID = "" ;
 if($id!='All'){$DeptID .= "WHERE DeptID='$id'" ; }else{$DeptID .= "" ; }
 return $this->db->query("SELECT * FROM QM_UserG5 $DeptID ORDER BY FullName ASC"); }
 
function DetailRole($id){  
 $this->db->where("SysID",$id);
 $this->db->order_by("NumOf", "DESC");
 return $this->db->get("QM_UserRole");  }
 
function ActivityList(){  
 return $this->db->get("T_30_ActMgr");  }
 
function ListUserGrpFlow(){  
 return $this->db->get("T_30_UserGrpFlow");  }

public function UserDelete($ID){
 $this->db->where('SysID',$ID);
 return $this->db->delete('M_UserG5'); }    

public function UserRoleDelete($ID){
 $this->db->where('SysID',$ID);
 return $this->db->delete('M_UserRole'); }  
 
public function DeleteRole($UserID,$NumOf){
 $this->db->where('UserID',$UserID);
 $this->db->where('NumOf',$NumOf);
 return $this->db->delete('M_UserRole'); }    
    
}