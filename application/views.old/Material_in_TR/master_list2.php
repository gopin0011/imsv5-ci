<table id="t_list_master_2" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartName</th>  
    <th>Spec</th>  
    <th>Unit</th> 
    <th>Category</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
$Spec = $row->Spec1 ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilihReport('<?php echo $row->RegID ;?>')">
<td width="300"><?php echo $PartName ; ?></td>
<td width="150"><?php echo $Spec; ?></td>
<td width="120"><?php echo $row->unit ; ?></td>          
<td align="center" width="120" ><?php echo $row->CodeCategory  ; ?></td>
<?php endforeach;?>
 </tbody>
</table>

    <script type="text/javascript"> 
function pilih(id){
	$("#myModal_product").modal('hide');
	$("#ItemID").val(id);
	$("#ItemID").focus(); }
</script>

    
    <script> $(function () { $("#t_list_master_2").DataTable(); });</script>