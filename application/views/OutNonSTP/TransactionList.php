<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Document No.</th>
<th>Created By</th>
<th>Product</th>
<th>Total</th></tr>  
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
 $Total = $row->TotalDetail ;
 $DocDate = $this->app_model->tgl_indo($row->DocDate) ; 
 $CreateDate = $this->app_model->tgl_str($row->CreateDate) ; 
 $DocNum = md5($row->DocNum) ;
?>
<tr class="odd gradeX" style="cursor: pointer;" onclick="javascript:PilihListTrc('<?php echo $row->DocNum;?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="50" ><?php echo $row->DocNum; ?><br /><?php echo $DocDate ; ?></td>
<td align="left" width="70" ><?php echo $row->CreateBy; ?> <br /><?php echo $CreateDate; ?>  <?php echo $row->CreateTime; ?></td>
<td align="left" width="300" ><?php echo $row->PartNo; ?><br /><?php echo $row->PartName; ?></td>
<td align="left" width="40" ><?php echo $Total ; ?> - Item</td></tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function PilihListTrc(id){
$("#DocNum2").val(id);
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function(){
$("#DocNum2").focus();
$("#DocNum2").click(); },800) ; return false(); }
</script>

<script> $(function () { $("#t_list_transaction").DataTable(); });</script>