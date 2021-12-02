<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Spec</th> 
    <th>Cust</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>
<td width="180"><?php echo $row->Spec1.' '.$row->Spec2 ; ?></td>          
<td align="center" width="180" ><?php echo $row->CustName ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

    <script type="text/javascript"> 
function pilih(id){
	$("#myModal_MaterialList").modal('hide');
	$("#ItemID3").val(id);
	$("#ItemID3").focus(); }
</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>