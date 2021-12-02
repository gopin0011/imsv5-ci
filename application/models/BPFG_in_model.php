<?php class BPFG_in_model extends CI_Model{
    
    function MasterList()
    {
        return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 ORDER BY IDCust DESC");
    }
    /**{{}}**/
    
    function transaction_list($limit = 50, $offset = 0)
    {
        //$limit= 50; $offset = 0;
        //"SELECT a.*, COUNT(b.*) as total FROM TH_Trans a LEFT JOIN b ON b.TH_RegID = a.RegID WHERE IDTrcType=2211 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"
        
        $sql = "SELECT a.DocNum ,a.DocNumDetail  , c.username, a.DocDate, a.to_area, a.RegID, a.from_area
                FROM TH_Trans a 
                JOIN M_User c ON c.RegID = a.create_id
                WHERE a.IDTrcType=2211 
                    AND a.RegID IN (SELECT TH_RegID FROM TD_Transdetail WHERE CASE WHEN isDelete = 1 THEN 'True' ELSE 'False' END = 'False' GROUP BY TH_RegID)
                ORDER BY a.RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        return $this->db->query($sql);
    }
    /**{{}}**/
    
    function transaction_list_warehouseIn($limit = 50, $offset = 0)
    {
        $sql = "SELECT a.*, b.DocNum as NewDocNum
                FROM QTH_RawMaterial a 
                LEFT JOIN TH_Trans b ON b.TH_RawMaterialID = a.RegID
                WHERE a.IDTrcType=605 AND dbo.fn_row_detail_bpfg(a.RegID) > 0 
                ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
       return $this->db->query($sql); 
    }
    /**{{}}**/
    
    function transaction_list_d_warehouseIn($id)
    {
        $sql = "SELECT bb.ItemID,bb.RegID,bb.PartNo,bb.PartName,bb.Code,(bb.QtyMat-ISNULL(aa.QtyMat,0)) as QtyMat, bb.Remark, aa.DocNum
                FROM
                	(SELECT SUM(b.QtyMat) AS QtyMat,b.TD_RawMaterial, a.DocNum
                                    FROM	TH_Trans a 
                                    LEFT JOIN TD_Transdetail b ON a.RegID=b.TH_RegID 
                					GROUP BY b.TD_RawMaterial, a.DocNum
                    ) aa
                RIGHT JOIN 
                    (
                        SELECT b.* 
                        FROM QTH_RawMaterial a 
                        LEFT JOIN QTD_RawMaterial b ON a.DocNum=b.DocNum 
                        WHERE a.IDTrcType=605 AND a.RegID = $id 
                    ) bb ON bb.RegID = aa.TD_RawMaterial
                WHERE (CASE WHEN aa.QtyMat IS NULL THEN 'true'
							WHEN aa.QtyMat < bb.QtyMat THEN 'true'
							ELSE 'false' END ) = 'true'";
        return $this->db->query($sql);
    }
    /**{{}}**/
    
    function MasterListPic()
    {
        return $this->db->query("SELECT * FROM ListPicTR ORDER BY id DESC"); 
    }
    /**{{}}**/
}    