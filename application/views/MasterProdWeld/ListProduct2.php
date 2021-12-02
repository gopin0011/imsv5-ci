<table id="t_list_master2" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Cust</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($List as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:SelectBOM2('<?php echo $row->SysID;?>','<?php echo $row->PartTypeID;?>')">
<td width="100"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="80" ><?php echo $row->Code.' '.$row->ProjectName ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script> $(function () { $("#t_list_master2").DataTable(); });</script>