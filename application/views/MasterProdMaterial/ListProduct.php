<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Spec</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($List as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:SelectBOM('<?php echo $row->ItemID;?>','<?php echo $row->PartType;?>')">
<td width="100"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="230" ><?php echo $row->SpecOrder1.' '.$row->SpecOrder2 ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script> $(function () { $("#t_list_master").DataTable(); });</script>