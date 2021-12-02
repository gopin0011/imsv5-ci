<div class="box-body"><div class="box box-success"><div class="box-body">
<div class="pull-left" data-toggle="tooltip">
<h4><small><span style="color: red;"><strong><?php echo $TotalItem ; ?></strong></span> - Asset Active</small></h4>

<div class="clearfix"></div></div></div></div></div>
<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Asset ID</th>
<th>Name</th>
<th>Department</th>
<th>Category</th>
<th>Qty</th>
<th></th>                       
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr class="odd gradeX">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="150" ><?php echo $row->ItemID ; ?></td>
<td align="left" width="200" ><?php echo $row->ItemName ; ?></td>
<td align="left" width="60" ><?php echo $row->Dept_Name ; ?></td>
<td align="left" width="60" ><?php echo $row->CategoryName ; ?></td>
<td align="left" width="60" ><?php echo number_format($row->Qty ) ; ?> <?php echo $row->unit ; ?></td>
<td align="center" width="40">
<?php  $cek = $this->session->userdata('CanEditMaster')=='1'; if(!empty($cek)){ ?>
<a onclick="PilihView('<?php echo $row->ItemID ; ?>', '<?php echo $row->Dept_Name ; ?>')" style="cursor: pointer;" title="View">
<i class="fa fa-eye"></i> </a>
<a onfocus="PilihHapus('<?php echo $row->ItemID ; ?>', '<?php echo $row->ItemName  ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false"  title="Delete">
<i class="glyphicon glyphicon-trash"></i> </a>
<a style="CURSOR: pointer; COLOR: #ff0000"  title="Print Label"
onclick="window.open(&#39;<?php echo base_url();?>index.php/MasterAsset/PrintLabel/<?php echo $row->ItemID  ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
<i class="glyphicon glyphicon-print"></i></a>
<?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_masterList").DataTable(); });</script>