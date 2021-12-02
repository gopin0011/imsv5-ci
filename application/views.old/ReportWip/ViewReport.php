<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th>No</th>
    <th>Product</th>
    <th>Customer</th>
	<th>Std Pack</th>
    <th>IN</th>
    <th>OUT</th> 
    <th align="center">Balance</th>
    <th>Day</th>
     <?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
    <th></th> <?php } ?>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
 $tgl_awal = $DocDateReport_1;
 $tgl_akhir = $DocDateReport_2;
 $Stock      = $row->StockWIP2;
 $PcsPerDay      = $row->PcsPerday;
 $WIP_IN   = $this->app_model->WIP_IN($row->ItemID,$tgl_awal,$tgl_akhir);
 $WIP_OUT  = $this->app_model->WIP_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
 $Awal       = ($Stock-$WIP_IN)+$WIP_OUT;
 if($PcsPerDay == 0 ) {
 $StockDay = 0 ; }else{
 $StockDay = $Stock / $PcsPerDay ;  } ;
 if($StockDay<1){ $bar="images/INDOKATOR/Danger.gif"; }
 if($StockDay>=1 && $StockDay<4){ $bar="images/INDOKATOR/Safe.gif"; }
 if($StockDay>=4 && $StockDay<10){ $bar="images/INDOKATOR/Coution1.gif"; }
 if($StockDay>10){ $bar="images/INDOKATOR/Coution2.gif"; }
 if($StockDay<1){ $bar2="images/INDOKATOR/Danger.gif"; }
 if($StockDay>=1 && $StockDay<4){ $bar2="images/INDOKATOR/Safe.gif"; }
 if($StockDay>=4 && $StockDay<10){ $bar2="images/INDOKATOR/Coution1.gif"; }
 if($StockDay>10){ $bar2="images/INDOKATOR/Coution2.gif"; }
 ?>
<tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="250" ><?php echo $row->PartNo; ?></td>
 <td width="350" ><?php echo $row->PartName; ?></td>
 <td align="left" width="100" ><?php echo $row->Code; ?> <?php echo $row->ProjectName; ?></td> 
 <td align="left" width="80" ><?php echo number_format($WIP_IN); ?> </td>
 <td align="left" width="80" ><?php echo number_format($WIP_OUT); ?> </td>
 <td align="left" width="80" ><?php echo number_format($row->StockWIP2); ?> </td>
 <td align="left" width="80" ><?php echo number_format($StockDay,2); ?>  
 <img alt="Brand" style="height: 20px; width: 20px;" src="<?php echo base_url(); ?><?php echo $bar ; ?>"></td>
 <td align="center" width="20">
 <?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
 <a onfocus="PilihEdit('<?php echo $row->ItemID ; ?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a>
 <?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />

<script type="text/javascript"> 
function PilihEdit(id){
 $("#ItemID").val(id);
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click(); },700) 
 return false(); }
</script>
 <script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>