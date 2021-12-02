<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Cust</th>
    <th>Project</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($List as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="80" ><?php echo $row->CustName ; ?></td>
<td align="left" width="50" ><?php echo $row->ProjectName ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script> $(function () { $("#t_list_master").DataTable(); });</script>