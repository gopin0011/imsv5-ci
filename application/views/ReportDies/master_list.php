<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Cust</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilihDies('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>        
<td align="center" width="180" ><?php echo $row->CustName ; ?> <?php echo $row->ProjectName ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
 <script> $(function () { $("#t_list_master").DataTable(); });</script>