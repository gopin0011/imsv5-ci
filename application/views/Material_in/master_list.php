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
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,45) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->SysID2;?>')">
<td width="120"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>
<td width="180"><?php echo $row->SpecOrder1 .' '.$row->SpecOrder2 ; ?></td>          
<td align="left" width="80" ><?php echo $row->Code .' '. $row->ProjectName ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

    <script type="text/javascript"> 
function pilih(id){
	$("#myModal_product").modal('hide');
	$("#ItemID").val(id);
	$("#PartNo").focus(); }
</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>