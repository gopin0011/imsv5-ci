<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.style9 {font-family: Arial, Helvetica, sans-serif;}
.style10 {font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
.style11 {font-size: 14px; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
</head>

<?php foreach($data as $db){  
 $total = $db->Yield ; 
 $cust = $db->CustName ;
 $line = $db->Line ;
 $DetailLine = $db->IDLineDetail ;
 $DocNumDetail = $db->DocNumDetail ;
 $PartNo =  $db->PartNo ;
 $PartName = $db->PartName ;
 $status = $db->StatusID  ;
 if($status == 2 ){
 $ProsesH = "" ;
 $ProsesD = "" ;
 $Garing = "" ;
 }else{
 $ProsesH = $db->ProsesH  ;
 $ProsesD = $db->ProsesD  ;
 $Garing = "/" ; } ?> 
	
    <div class="style10">SAI/RC/QA/03/05</div>	
<table width="330" height="340" border="1" cellspacing="0">
  <tr>
    <td width="149" rowspan="2"><div class="style9" align="center"><img src="<?php echo base_url();?>assets/images/adw.png" width="120" height="30" alt=""/></div></td>
    <td height="35" colspan="4"><div align="center" class="style9"><h3 class="style10">IDENTIFY PROD </h3></div></td>
    
  </tr>
  <tr>
    <td height="34" colspan="2"><div align="center"><h3 class="style10"><?php echo $line; ?> - <?php echo $DetailLine; ?> </h3></div></td>
    <td colspan="2"><div align="center"><span class="style10"> <?php echo $DocDate ; ?></span></div></td>
  </tr>
  <tr>
    <td height="23"><div align="center"><span class="style10">Part No </span></div></td>
    <td colspan="4"><div align="center"><span class="style10">Part Name</span></div></td>
  </tr>
  <tr>
    <td height="90"><div align="center"><span class="style11"><?php echo $db->PartNo ; ?> </span></div></td>
    <td colspan="4"><div align="center"><span class="style11"><?php echo $PartName ; ?> </span></div></td>
  </tr>
  <tr>
    <td colspan="6"><div align="left"><span class="style11"><strong><?php echo $db->Customer  ; ?></strong> </span></div></td>
  </tr>
  <tr>
      <td height="30"><div align="left" class="style9">STD Pack : <span class="style1"><?php echo $db->StdPack  ; ?></span> </div></td>
    <td width="84" colspan="2"><div align="center" class="style2"><span class="style9"> REMARK</span></div></td>
    <td width="84" colspan="2"><div align="center" class="style2"><span class="style9"> QC CHECK</span></div></td>
  </tr>
  <tr>
    <td height="108" rowspan="3"><div align="center"><span class="style9"><img src="<?php echo site_url();?>/OutNonSTP/bikin_barcode/<?php echo $DocNumDetail ;?>"></span></div></td>
    <td width="84" colspan="2"><div align="center"><span class="style2"> <h3><?php echo $ProsesD ; ?><?php echo $Garing ; ?><?php echo $ProsesH ; ?> <?php echo $db->Status ; ?></strong> </h3></div></td>
    <td colspan="2"><div align="center"><span class="style2"><?php echo $db->QCCheck  ; ?></span></div></td>
  </tr>
  <tr>
    <td colspan="4"><div align="left"><span class="style10">OP 1 : <?php echo $db->OP1 ; ?></span></div></td>
    
  </tr>
  <tr>
    <td colspan="4"><div align="left"><span class="style10">OP 2 : <?php echo $db->OP2 ; ?></span></div></td>
    
  </tr>
</table>


<?php } ?>

<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
</body>
</html>