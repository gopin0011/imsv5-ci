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
if($num>0){
$kanan = "<table class='kanan' width='100%'>
		  <tr>
		  	<td colspan='2'>Download By</td>
			<td width='5'  colspan='4'>: ".$this->session->userdata('nama_lengkap')."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Filter</td>
			<td width='5' colspan='4'>: ".$filter."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Category</td>
			<td width='5' colspan='4'>: ".$IDCategory."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Supplier</td>
			<td width='5' colspan='4'>: ".$PartnerID."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Product</td>
			<td width='5' colspan='4'>: ".$ItemID."</td>
		  </tr>
		  </table>";
function myheader($kanan){
?>
<div class="atas">
<table width="100%">
<tr>
	
    </td>
	<td width="100%" valign="top" style="alignment-adjust: middle;">
    	 <?php echo $kanan ;?>
    </td>
</tr>    
</table>
</div>
<table class="grid" width="100%">
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th> 
    <th width="10%">Category</th> 
    <th width="10%">Created by</th>
    <th width="7%">Date</th>
    <th>PartNo</th>
    <th>PartName</th>
    <th>Spec</th> 
    <th width="10%">SJ Num</th>
    <th width="10%">Suplier</th>
    <th width="6%">Qty</th>
</tr>   
<?php } 
function myfooter(){	
	echo "</table>";
}

$g_total=0;
$no=1;
$page =1;
foreach($data as $row){  
$total = $row->QtyMat;
$tgl = $row->DocDate;
$jam = $row->DocTime; 
$SJNum = $row->SJNum ;
$Partner = $row->partner_code ;
$Category = $row->Category ;
	if(($no%100) == 1){
   	if($no > 1){
   	    $ofPage = ceil(($num) / 100);
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center' colspan='8'>Page $page of $ofPage</div>
		</div>";
		$page++;
  	} 
      myheader($kanan);
      }
	?>
 <tr>
 <td align="left"><?php echo $no; ?></td>
 <td align="left"><?php echo $row->DocNumDetail; ?></td>
 <td align="left"><?php echo $Category; ?></td>
 <td align="left"><?php echo $row->CreateBy; ?></td>
 <td align="left"><?php echo $tgl ; ?></td>
 <td ><?php echo $row->PartNo ; ?></td>
 <td ><?php echo $row->PartName; ?></td>
 <td ><?php echo $row->Spec2; ?></td>
 <td align="left"><?php echo $SJNum ; ?></td>
 <td align="left"><?php echo $Partner ; ?></td>
 <td align="left"><?php echo number_format($row->QtyMat); ?></td>
 </tr>
    <?php
	$no++;
	$g_total = $g_total;
    $ofPage = ceil(($num) / 100);
	}
echo "";
echo "";
myfooter();
echo "</table>";	
echo "<div class='page' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=GA_Product-IN.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<?php }else{	 echo "<div><center><h1>No data available</h1></center></div>"; } ?>

