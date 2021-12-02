<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Customer</th>
<th>So Number</th>
<th>Promise Date</th>
<th>Line</th>
<th>Product</th>
<th>Qty SO</th>
<th>Qty Gap</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$DocDateX = substr($row->DelivDate,0,10) ;
$DocDate = $this->app_model->tgl_str($DocDateX);
?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="100" ><?php echo $row->PartnerCode ; ?></td>
<td align="left" width="40" ><?php echo $row->C050_DocNum ; ?></td>
<td align="left" width="40" ><?php echo $DocDate ; ?></td>
<td align="left" width="20"><?php echo $row->Line ; ?></td>
<td align="left" width="300"><?php echo $row->ItemNum ; ?> <br /><?php echo $row->ItemName ; ?></td>
<td align="left" width="40" ><?php echo $row->QtySO ; ?></td>
<td align="left" width="40" ><?php echo $row->GapQty ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function Pilih(id){
 $("#RegID").val(id);
 setTimeout(function(){
 $("#RegID").focus();
 $("#RegID").click(); },700) 
 return false(); }
</script>
<script> $(function () { $("#t_masterList").DataTable(); });</script>