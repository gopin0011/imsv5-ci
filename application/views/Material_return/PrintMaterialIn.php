<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {
	font-weight: bold;
	font-size: 9px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style2 {font-size: 9}
.style4 {font-weight: bold; font-size: 9; }
.style5 {
	font-size: 16px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style6 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style7 {font-weight: bold; font-size: 9; font-family: Geneva, Arial, Helvetica, sans-serif; }
.style9 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
.style10 {font-weight: bold}
.space {margin-top: 100px;}
-->
</style>
</head>

<body>

<?php
$no=0;
foreach($data as $db):  
$no++;
$total =  $db->Qty_1;
$kodeinput_mpc =  $db->DocNum;
$id =  $db->DocNumDetail;
$part_no =  $db->PartNo;
$part_name =  $db->PartName;
$tgl = $this->app_model->tgl_indo($db->DocDate);
$jml = $db->Qty_1;
$cust = $db->CustName;
$MaterialType = $db->MaterialTypeID ;
$total_keluar = $total + $db->Qty_5  ;
 $pcs_kg = number_format($db->KgPerSheet,4);
 if($MaterialType==1){
 $UOM = $pcs_kg ; } 
 $pcs_sheet = number_format($db->PcsPerSheet,0);
 if($MaterialType==2){
 $UOM = $pcs_sheet; } 
 ?>
        
<table width="1000" border="1" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center" class="style6"><img src="<?php echo base_url();?>assets/images/adw.png" width="250" height="64"></div></td>
    <td colspan="12"><div align="center" class="style6">
      <h4>Label Material Return </h4>
    </div>      <div align="center" class="style6"></div>      
    <div align="center" class="style6">Production - Inventory Raw Material</div></td>
  </tr>
  <tr class="style6">
    <td colspan="3"><div align="center" class="style6"></div>      
        <div align="center" class="style6">SPEC</div>
    <span class="style9"></span></div>          
     <div align="center" class="style9"></div></td>
    <td colspan="12"><div align="center">PART</div></td>
  </tr>
  <tr class="style6">
    <td colspan="3" rowspan="2"><div align="center" class="style9"></div>      
    <div align="center" class="style9"><?php echo $db->SpecOrder1; ?> <?php echo $db->SpecOrder2; ?></div>      
    <div align="center" class="style9"></div>      
     </td>
    <td colspan="12"><div align="center" class="style9"><?php echo $part_no ; ?></div></td>
  </tr>
  <tr>
    <td colspan="12"><div align="center" class="style9"><?php echo $part_name ; ?></div></td>
  </tr>
  <tr class="style6" height="15">
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
            <div align="center" height="15">
                    <pre>QTY</pre>
        </div>
    </div></td>
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
            <div align="center" height="15">
                    <pre>PCS/UNIT</pre>
        </div>
    </div></td>
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
          <div align="center" height="15">
                <pre>TOTAL</pre>
        </div>
    </div></td>
    <td width="300" rowspan="3"><div align="center" class="style9"><img src="<?php echo site_url();?>/OUTMaterial/bikin_barcode/<?php echo $id ;?>" style="width: 230px;"></div>    
    <td width="366" colspan="10" height="15"><div align="center" class="style6">PETUGAS</div>            
    <div align="center" class="style9"></div></td>
  </tr>
  <tr class="style6">
    <td rowspan="2"><div align="center" class="style9"><?php echo number_format($total) ; ?></div></td>
    <td rowspan="2"><div align="center" class="style9"><?php echo $UOM ; ?></div></td>
    <td rowspan="2"><div align="center" class="style9"><?php echo number_format($db->Qty_2,0) ; ?></div></td>
    <td colspan="10" height="25" ><div align="center" class="style9"><?php echo $db->username; ?></div>   </tr>
  <tr>
    <td colspan="10" height="15"><div align="center" class="style6">PIC Productin</div>   
    </tr>
  <tr>
  <td colspan="3"><div align="center" class="style6"></div>           
     <div align="center" class="style6"></div>      
      <div align="center" class="style6">
        <div align="left">Total : <strong><?php echo $db->Qty_5 ; ?></strong></div>
    </div></td>
    
    <td colspan="1"><div align="center" class="style6"></div>           
     <div align="center" class="style6"></div>      
      <div align="center" class="style6">
        <div align="left"><?php echo $db->DocTime; ?> / <?php echo $tgl ; ?></div>
    </div></td>
    <td colspan="10" height="25">
    <div align="center" class="style6"></div>      
    </td>
  </tr>
  
   <tr><span>
  SAI/RC/PPIC/03/04</span>
  </tr>
  <br /><br />
</table>
<br /><br /><br />
<?php endforeach;?>




    


<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
</body></html>