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
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:SelectProduct('<?php echo $row->SysID2 ;?>','<?php echo $row->PartNo ;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>
<td width="180"><?php echo $row->SpecOrder1.' '.$row->SpecOrder2 ; ?></td>          
<td align="center" width="180" ><?php echo $row->Code ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_list_master").DataTable(); });</script>