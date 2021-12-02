<?php class MasterProdWeld_model extends CI_Model{


function MasterList($id){ 
 if(empty($id)){$IDCust ="" ;}else{$IDCust ="AND IDCust='$id'" ;}
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsWelding=1 $IDCust ORDER BY PartName ASC"); }

function ExportProduct($CustID){ 
 return $this->db->query("SELECT * FROM Master_BOM WHERE IDCust='$CustID' ORDER BY IDCust DESC"); }     

function ListProduct(){ 
return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%PC%' ORDER BY SysID ASC"); }

function ListProduct2(){ 
return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%FG%' ORDER BY SysID ASC"); }


function ConectingChildPart($id){  
 $this->db->where("ItemID",$id);
 return $this->db->get("QM_ChildPart_Conecting2");  }

function ConectingBomList($id){  
 $this->db->where("ItemID_Product",$id);
 return $this->db->get("QCMProduct_BOM1");  }
 
public function DeleteConecting($SysID){
 $this->db->where('SysID',$SysID);
 return $this->db->delete('M_ChildPart_Conecting'); }     

public function DeleteConecting2($SysID){
 $this->db->where('SysID',$SysID);
 return $this->db->delete('CMProduct_BOM'); } 
     
}