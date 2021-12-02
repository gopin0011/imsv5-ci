<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No.</th>
<th>Document No.</th>
<th>Date</th>
<th>Created By</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $TotalMaterialInMPC = $this->app_model->TotalMaterialInMPC($row->DocNum);
 $DocDate = $this->app_model->tgl_str($row->DocDate) ; 
 $DocNum = md5($row->DocNum) ;
?>
<tr class="odd gradeX" style="cursor: pointer;" onclick="javascript:PilihListTrc('<?php echo $row->DocNum;?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->DocNum; ?></td>
<td align="left" width="300"><?php echo $DocDate ; ?> <?php echo $row->DocTime; ?></td>
<td align="left" width="40" ><?php echo $row->CreateBy; ?></td>
<td align="left" width="40" ><?php echo $row->TotalDetail ; ?> - Item</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function PilihListTrc(id){
 $("#DocNum2").val(id);
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#DocNum2").focus();
 $("#DocNum2").click();
 },800) 
 return false();
 }
</script>
    
<script> $(function () { $("#t_list_transaction").DataTable(); });</script>