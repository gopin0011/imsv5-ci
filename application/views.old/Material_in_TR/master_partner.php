<table id="t_list_master_partner" class="table table-bordered table-striped">
<thead>
<tr>
<th>Code</th>  
<th>Supplier</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MasterListPartner as $db): 
$no++;
$PartNo = substr($db->partner_code,0,15) ;
$PartName = substr($db->partner_name,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih2('<?php echo $db->id;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>
<script> $(function () { $("#t_list_master_partner").DataTable(); });</script>