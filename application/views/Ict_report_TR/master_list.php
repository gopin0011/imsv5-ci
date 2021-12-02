<!-- start master_list.view -->

<table id="t_list_master_SC" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>Product</th>   
<th>Spec</th> 
<th>Category</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="pilihSC('<?php echo $row->RegID;?>','<?php echo $row->PartNo;?>','<?php echo $row->PartName;?>','<?php echo $row->Spec1;?>','<?php echo $row->unit;?>','<?php echo $row->category_name ;?>')">
<td width="150"><?php echo $PartName; ?> <?php echo $PartNo ; ?></td>
<td width="180"><?php echo $row->Spec1; ?></td>
<td width="180"><?php echo $row->category_name; ?></td>
</tr>
<?php endforeach ;?>
</tbody>
</table>

<script type="text/javascript"> 
function pilihSC(RegID,PartNo,PartName,Spec,Unit,Category){
$("#myModal_MaterialList").modal('hide');
$("#ItemID").val(RegID);
$("#PartNo").val(PartNo);
$("#PartName").val(PartName);
$("#Spec1").val(Spec);
$("#Unit").val(Unit);
$("#Category").val(Category); }
</script>

    
<script> $(function () { $("#t_list_master_SC").DataTable(); });</script>

<!-- end master_list.view -->