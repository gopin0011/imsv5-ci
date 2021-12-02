<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>Reg</th> 
    <th>Product</th>
    <th>PIC</th> 
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
 $DocNum = md5($row->DocNum) ;
 $DocNumDetail = $row->DocNumDetail ;
 $UOM = $row->CodeUnit ;
?>
<tr class="odd gradeX">
<td align="left" width="20"><?php echo $no; ?></td>
<td align="left" width="20"><?php echo $row->DocNumDetail ; ?>  
<td width="300"><?php echo $PartNo ; ?> - <?php echo $PartName ; ?></td>
<td align="left" width="165" ><?php echo $row->nama_singkat; ?> - <?php echo $row->Dept_Name; ?></td> 
<td align="right" width="100" ><?php echo number_format($QtyMat); ?> <?php echo $UOM ; ?></td>
<?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
<?php $cek2 = $this->Role_Model->TrcStoreRoomUp(); if(!empty($cek2)){ ?>
<td align="center" width="30">
<a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-edit"></i> </a>
<?php $cek3 = $this->Role_Model->TrcStoreRoomDel(); if(!empty($cek3)){ ?>
<a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartName ; ?>', '<?php echo $QtyMat ; ?>', '<?php echo $row->Amount ; ?>', '<?php echo $row->BalMatSource ; ?>', '<?php echo $row->BalAmountSource ; ?>', '<?php echo $row->CanEdit ; ?>', '<?php echo $row->SourceDocNum ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </a><?php } ?>
</td><?php } ?><?php } ?>
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
    });
  });
</script>
    
    <script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>