<table id="t_masterList_2" class="table table-bordered table-striped">
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
<?php  $cek = $this->Role_Model->MAssetUp(); if(!empty($cek)){ ?>
<a onfocus="PilihEdit('<?php echo $row->ItemID  ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false"  title="Edit">
<i class="fa fa-edit"></i> </a>
<?php  $cek = $this->Role_Model->MAssetDel(); if(!empty($cek)){ ?>
<a onfocus="PilihHapus2('<?php echo $row->ItemID  ; ?>', '<?php echo $row->ItemName  ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false"  title="Delete">
<i class="glyphicon glyphicon-trash"></i> </a><?php } ?>
<a style="CURSOR: pointer; COLOR: #ff0000"  title="Print Label"
onclick="window.open(&#39;<?php echo base_url();?>index.php/MasterAsset/PrintLabel/<?php echo $row->ItemID  ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
<i class="glyphicon glyphicon-print"></i></a>
<?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_masterList_2").DataTable(); });</script>