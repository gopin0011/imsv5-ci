<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Document No.</th>
<th>Date</th>
<th>User</th>
<th>Total</th>
<th>View</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->TotalDetail ;
$DocDate = $this->Material_return_model->tgl_str($row->DocDate) ; 
$DocNum = md5($row->DocNum) ;
?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="left" width="80"><?php echo $row->DocNum ; ?></td>
<td align="left" width="80"><?php echo $DocDate ; ?></td>
<td align="left" width="80"><?php echo $row->username ; ?></td>
<td align="right" width="60"><?php echo $Total ; ?> - Item</td>
<td align="center" width="10">
<a onfocus="view_detail('<?php echo $row->DocNum ; ?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
Detail </a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function view_detail(DocNum){
$("#DocNum2").val(DocNum);
setTimeout(function(){
$("#DocNum2").focus();
$("#DocNum2").click();
setTimeout(function(){
$("#DocNum2").focus();
$("#DocNum2").click(); },300) ; },500) 
return false(); }
</script>


<script> $(function () { $("#t_list_transaction").DataTable(); });</script>