<table id="t_UserGrpFlow" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>UserGrpFlow</th>
<th>SysID</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row):  
$no++; ?>
<tr onclick="UserGrpFlowAdd('<?php echo $row->SysID ; ?>')" style="cursor: pointer;">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="500" ><?php echo $row->Descr ; ?></td>
<td align="left" width="500" ><?php echo $row->SysID ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script> $(function () { $("#t_UserGrpFlow").DataTable(); });</script>