<?php class MasterProdDelivery_model extends CI_Model{


function MasterList($id){ 
 if(empty($id)){$IDCust ="" ;}else{$IDCust ="AND IDCust='$id'" ;}
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 $IDCust ORDER BY PartName ASC"); }


function ExportProduct($CustID){ 
 return $this->db->query("SELECT * FROM Master_BOM WHERE IDCust='$CustID' ORDER BY IDCust DESC"); }     

function ListProduct(){ 
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%FG%' ORDER BY SysID ASC"); }    

function ConectingBomList($id){  
 $this->db->where("ItemID_Product",$id);
 return $this->db->get("QCMProduct_BOM1");  }

public function DeleteConecting($SysID){
 $this->db->where('SysID',$SysID);
 return $this->db->delete('CMProduct_BOM'); } 
     
}