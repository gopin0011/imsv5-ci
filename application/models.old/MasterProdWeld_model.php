<?php class MasterProdWeld_model extends CI_Model{


function MasterList($id){ return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsWelding=1 AND IDCust='$id' ORDER BY PartName ASC"); }
function ExportProduct($CustID){ return $this->db->query("SELECT * FROM Master_BOM WHERE IDCust='$CustID' ORDER BY IDCust DESC"); }     
function ListProduct(){ 
return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 ORDER BY IDCust DESC"); }
    
    
}