

<script>
function textAreaAdjust(o) {
    o.style.height = "55px";
    o.style.height = (22+o.scrollHeight)+"px";
    tampil_data();
}
</script>
<script>
function textAreaAdjustOut(o) {
o.style.height = "77px";
o.style.border.right = "none" ;
o.style.border.bottom = "none" ;
o.style.border.top = "none" ;
tampil_data();
}
</script>

<script>
function bigImg(x) {
    x.style.height = "21px";
    x.style.width = "21px";
}

function normalImg(x) {
    x.style.height = "20px";
    x.style.width = "20px";
}
</script>


<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>Reg</th>
    <th>Product</th>
    <th>Supplier</th> 
    <th>Total</th>
    <?php $cek = $this->Role_Model->TrcStoreRoomUp(); if(!empty($cek)){ ?>
    <th></th><?php } ?>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$QtyMat =  $row->QtyMat ;  
$Amount =  $row->Amount ;  
$PartNo =  substr($row->PartNo,0,15);
$PartName =  $row->PartName;
$MatNum =  $row->MatNum;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = $row->DocNumDetail ;
?>
<tr class="odd gradeX">
<td align="left" width="20"><?php echo $no; ?></td>
<td align="left" width="50"><?php echo $row->DocNumDetail ; ?><br /><?php echo $row->SJNum ; ?> </td>
<td width="200"><?php echo $PartName ; ?></td>
<td align="left" width="60" ><?php echo $row->partner_code; ?></td> 
<td align="left" width="20" ><?php echo number_format($QtyMat); ?></td>
<?php $cek = $this->Role_Model->TrcStoreRoomUp(); if(!empty($cek)){ ?>
<td align="center" width="30">
<?php  $cek2 = $row->CanEdit=='0'; if(!empty($cek2)){ ?>
<a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-edit"></i> </a><?php } ?>
<?php $cek3 = $this->Role_Model->TrcStoreRoomDel(); if(!empty($cek3)){ ?>
<a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>', '<?php echo $row->CanEdit ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </a>
<?php } ?></td><?php } ?>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script>
$(function () {
$("#example1").DataTable();
$('#example2').DataTable({
"paging": true,
"lengthChange": false,
"searching": false,
"ordering": true,
"info": true,
"autoWidth": false
}); });
</script>
    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>