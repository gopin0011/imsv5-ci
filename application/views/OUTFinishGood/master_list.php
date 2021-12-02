<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Cust</th>
    <th>Std Pack</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="80" ><?php echo $row->CustName ; ?></td>
<td align="left" width="50" ><?php echo $row->StdPack ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script type="text/javascript"> 
function pilih(id){
 $("#myModal_product").modal('hide');
 $("#ItemID").val(id);
 $("#ItemID").focus(); }
</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>