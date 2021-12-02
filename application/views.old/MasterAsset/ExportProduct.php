<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.99cm ;
font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
}
table.grid tr td{
	padding:2px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;
width:20.99cm ;
margin:0px;
padding:0px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20.99cm ;
font-size:13px;
}
.page {
width:20.99cm ;
font-size:12px;
padding:10px;
}

</style>
<?php
if($num > 0){
$kanan = "<table class='kanan' width='100%'>
		  <tr>
		  	<td colspan='2'>Download By</td>
			<td width='5'  colspan='4'>: ".$this->session->userdata('nama_lengkap')."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Location</td>
			<td width='5' colspan='4'>: ".$LocationID."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Cost Center</td>
			<td width='5' colspan='4'>: ".$DeptID."</td>
		  </tr>
		  </table>";
function myheader($kanan){
?>
<div class="atas">
<table width="100%">
<tr>
	
    </td>
	<td width="100%" valign="top" style="alignment-adjust: middle;">
    	<?php echo $kanan;?>
    </td>
</tr>    
</table>
</div>
<table class="grid" width="100%">
<tr>
    <th class="tg-l77s">No</th>
    <th class="tg-l77s">ID</th>
    <th class="tg-l77s" colspan="2">Asset Name</th>
    <th class="tg-a2cf">Location</th>
    <th class="tg-a2cf">Cost Center</th>
    <th class="tg-a2cf">Date</th>
    <th class="tg-a2cf">Vendor</th>
    <th class="tg-a2cf">Price</th>
    <th class="tg-a2cf">Qty</th>
    
</tr>   
<?php
}
function myfooter(){	
	echo "</table>";
}
$g_total=0;
	$no=1;
	$page =1;
		foreach($list as $db){  
		$Qty =  $db->Qty  ;
        $Price =  $db->Price  ;
        $Date = $this->app_model->tgl_str($db->PurchaseDate ) ;
	if(($no%1500) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($kanan);
	}
	?>
    	<tr>
	<td class="tg-h31u"><?php echo $no; ?></td>
    <td class="tg-h31u"><?php echo $db->ItemID  ; ?></td>
    <td class="tg-h31u" colspan="2"><?php echo $db->ItemName  ; ?></td>
    <td class="tg-h31u1"><?php echo $db->Location ; ?></td>
    <td class="tg-h31u1"><?php echo $db->Dept_Name ; ?></td>
    <td class="tg-h31u1"><?php echo $Date ; ?></td>
    <td class="tg-h31u1"><?php echo $db->partner_code  ;?></td>
    <td class="tg-h31u12"><?php echo number_format($Price); ?></td>
    <td class="tg-h31u12"><?php echo number_format($Qty); ?></td>

            
    </tr>
    <?php
	$no++;
	$g_total = $g_total;
	}
	echo "";
echo "";
myfooter();	
	echo "</table>";	
	echo "<div class='page' align='center'>Hal - ".$page."</div>";

        header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=AssetList.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
?>
<?php
}else{	
echo "<div><center><h1>No data available</h1></center></div>";

	} ?>

