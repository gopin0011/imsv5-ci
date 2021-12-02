<table id="t_DetailConecting" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>PartNo</th>
<th>PartName</th>
<th>Customer</th>
<th>Project</th>
<th></th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row):  
$no++; ?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="100" ><?php echo $row->PartNo ; ?></td>
<td align="left" width="200"><?php echo $row->PartName ; ?></td>
<td align="left" width="40"><?php echo $row->CustName ; ?></td>
<td align="left" width="40"><?php echo $row->ProjectName ; ?></td>
<td align="center" width="10" ><a style="cursor: pointer;" id="Del2_<?php echo $row->SysID ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i onclick="ActionDelete2('<?php echo $row->SysID ; ?>')" style="cursor: pointer;" title="Delete" class="fa fa-trash"></i></td>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script> $(function () { $("#t_DetailConecting").DataTable(); });</script>