<?php class MonitoringStockFG_model extends CI_Model{


function MasterList($id){   
 return $this->db->query("SELECT * FROM MonitoringFG WHERE IDCust='$id' ORDER BY hari ASC"); }
function ExportProduct($CustID){ return $this->db->query("SELECT * FROM Master_BOM WHERE IDCust='$CustID' ORDER BY IDCust DESC"); }     
function ListProduct(){ 
return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 ORDER BY IDCust DESC"); }    
    
}