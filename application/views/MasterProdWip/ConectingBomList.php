<table id="t_DetailRole" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>PartNo</th>
<th>PartName</th>
<th>Specs 1</th>
<th>Specs 2</th>
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
<td align="left" width="40"><?php echo $row->SpecOrder1 ; ?></td>
<td align="left" width="40"><?php echo $row->SpecOrder2 ; ?></td>
<td align="center" width="10" ><a style="cursor: pointer;" id="Del_<?php echo $row->SysID ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i onclick="ActionDelete('<?php echo $row->SysID ; ?>')" style="cursor: pointer;" title="Delete" class="fa fa-trash"></i></td>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script> $(function () { $("#t_DetailRole").DataTable(); });</script>