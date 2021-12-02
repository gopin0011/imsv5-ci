<!-- start PrintListKecil.view -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
table {
    border-collapse: collapse;
    border-color: #000;
}

table tr td {
    padding: 10px 10px 10px 10px;
    border-color: #000;
}

span {
    font-size: small;
    font-style: italic;
    font-weight: bold;
}
</style>
</head>

<?php foreach($data as $db){  
 //$total = $db->Yield ; 
 //$cust = $db->CustName ;
 //$line = $db->Line ;
 //$DetailLine = $db->IDLineDetail ;
 //$DocNumDetail = $db->DocNumDetail ;
 //$PartNo =  $db->PartNo ;
 //$PartName = $db->PartName ;
 //$status = $db->StatusID  ;
 
 ?> 
	
<div class="style10">&nbsp;</div>	
<table width="330" height="340" border="1">
  <tr style="height: 80px;">
    <td colspan="2"><div align="center"><h3>Bukti Penyerahan Part</h3></div></td>
    <!--<td height="35" colspan="4"><div align="center" class="style9"><h3 class="style10">BPP</h3></div></td>-->
  </tr>
  <tr>
    <td colspan="2"><div align="center"><img src="<?php echo site_url().'/BPFG/bikin_barcode/'.$db->DocNum;?>" style="width: 200px;"></div></td>
  </tr>
  <tr>
    <td colspan="2">Jumlah: <span><?php echo $db->JmlItem; ?>&nbsp;Item</span></td>
  </tr>
  <tr>
    <td width="155">User: <span><?php echo $db->username;?></span></td>
    <td width="155">Tanggal: <span><?php echo date('d-m-Y',strtotime($db->DocDate));?></span></td>
  </tr>
  <!--
  <tr>
    <td height="23"><div align="center"><span class="style10">Part No </span></div></td>
    <td colspan="4"><div align="center"><span class="style10">Part Name</span></div></td>
  </tr>
  <tr>
      <td height="30"><div align="left" class="style9">STD Pack : <span class="style1"></span> </div></td>
    <td width="84" colspan="2"><div align="center" class="style2"><span class="style9"> REMARK</span></div></td>
    <td width="84" colspan="2"><div align="center" class="style2"><span class="style9"> QC CHECK</span></div></td>
  </tr>
  -->
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

<!-- end PrintListKecil.view -->