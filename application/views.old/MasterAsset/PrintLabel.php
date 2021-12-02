<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;margin:5px auto;}
.tg td{font-family:Arial, sans-serif;font-size:6px;padding:2px 1px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;}
.tg th{font-family:Arial, sans-serif;font-size:6px;font-weight:normal;padding:2px 1px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-top-width:1px;border-bottom-width:1px;}
.tg .tg-s6z2{text-align:center}
.tg .tg-093g{font-weight:bold;font-style:italic;text-align:center}
.tg .tg-5rxl{font-weight:bold;font-style:italic;font-size:12px;text-align:center}
.tg .tg-hgcj{font-weight:bold;font-size:12px;text-align:center}
.tg .tg-bdt2{font-weight:bold;font-size:8px;font-family:Arial, Helvetica, sans-serif !important;}
.tg .tg-h6r7{font-weight:bold;font-size:8px;font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-fovp{font-weight:bold;font-size:8px;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-vozr{font-weight:bold;font-size:14px;text-align:center;vertical-align:middle}
.tg .tg-vozr1{font-weight:bold;font-size:2px;text-align:center;vertical-align:middle}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 320px">
<?php
	if($num >0){
		$g_total=0;
		$no =1;
		foreach($list as $db){ 
		  $ItemID = $db->ItemID  ;
          $ItemName = $db->ItemName  ;
          $CategoryName = $db->CategoryName  ;
          
          $Date = $this->app_model->tgl_str($db->PurchaseDate ) ;
		?> 
        
<colgroup>
<col style="width: 50px">
<col style="width: 100px">
<col style="width: 50px">
<col style="width: 50px">
</colgroup>


        
  <tr>
    <th class="tg-5rxl" colspan="4" rowspan="2" style="border-bottom: none; border-top: none;">ASSET CARD</th>
  </tr>
  <tr>
  </tr>
  <tr>
    <td class="tg-hgcj" colspan="4" style="border-top: none; border-top: none; border-bottom: dotted 1px; border-bottom-width: dotted 1px;">PT. SUMMIT ADYAWINSA INDONESIA</td>
  </tr>
  <tr>
    <td class="tg-s6z2" colspan="4" style="border-bottom: none; border-top: none;"></td>
  </tr>
  <tr>
    <td class="tg-bdt2" style="border-top: none;border-bottom: none; ">Asset Name</td>
    <td class="tg-bdt2" colspan="3" style="border-top: none;border-bottom: none;">: <?php echo $ItemName ;?></td>
  </tr>
  <tr>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Assset Code</td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">: <?php echo $ItemID ;?></td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Date</td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">: <?php echo $Date ;?></td>
  </tr>
  <tr>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Asset Type</td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">: <?php echo $db->CategoryName  ;?></td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Vendor</td>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">: <?php echo $db->partner_code  ;?></td>
  </tr>
  <tr>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Cost Center</td>
    <td class="tg-bdt2"style="border-top: none; border-bottom: none;">: <?php echo $db->Dept_Name  ;?></td>
    <td class="tg-bdt2" colspan="2" style="border-top: none; border-bottom: none;"></td>
  </tr>
  <tr>
    <td class="tg-bdt2" style="border-top: none; border-bottom: none;">Serial No</td>
    <td class="tg-bdt2" colspan="3" style="border-top: none; border-bottom: none;">: <?php echo $db->ItemNo  ;?></td>
  </tr>
  <tr>
    <td class="tg-fovp" colspan="4" style="border-top: none; border-bottom: none;"></td>
  </tr>
  
  <tr>
  
    <td class="tg-vozr1" colspan="4" style="border-top: none; border-bottom: dotted 1px; border-bottom: dotted 1px;">
    <img src="<?php echo site_url();?>/INMaterial/bikin_barcode/<?php echo $ItemID ;?>" style="height: 45px;"></td>
    
  </tr>
  
   <?php
		$no++;
		$g_total=$g_total;
		}
	}else{
		$g_total=0;
	?>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    <?php	
	}
?>

</table>
<span style="font-weight:bold;font-size:8px;font-family:Arial, Helvetica, sans-serif;"><em>IMS 2017</em></span>
<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>