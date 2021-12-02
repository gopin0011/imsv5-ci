<table id="t_ActivityList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Activity</th>
<th>Code Name</th>
<th>SysID</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row):  
$no++; ?>
<tr onclick="AddActList('<?php echo $row->SysID ; ?>')" style="cursor: pointer;">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="500" ><?php echo $row->ObjTitle ; ?></td>
<td align="left" width="500" ><?php echo $row->CodeName ; ?></td>
<td align="left" width="500" ><?php echo $row->SysID ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script> $(function () { $("#t_ActivityList").DataTable(); });</script>