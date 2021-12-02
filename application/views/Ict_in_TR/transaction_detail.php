<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>Reg</th>
    <th>Product</th>
    <th>Supplier</th> 
    <th>Total</th>
    <?php  $cek = $this->Role_Model->TrcICTUp(); if(!empty($cek)){ ?>
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
<?php  $cek = $this->Role_Model->TrcICTUp(); if(!empty($cek)){ ?>
<td align="center" width="30">
<?php  $cek2 = $row->CanEdit=='0'; if(!empty($cek2)){ ?>
<a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-edit"></i> </a>
<?php  $cek3 = $this->Role_Model->TrcICTDel(); if(!empty($cek3)){ ?>
<a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $DocNumDetail ; ?>', '<?php echo $row->CanEdit ; ?>', '<?php echo $row->ItemID ; ?>', '<?php echo $row->QtyMat ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </a><?php } ?>
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