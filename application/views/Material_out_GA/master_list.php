<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>Reg</th>  
<th>Product</th>  
<th>Category</th> 
<th>Qty</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,25) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih3('<?php echo $row->DocNumDetail;?>')">
<td align="left" width="60" ><?php echo $row->DocNumDetail ; ?></td>
<td width="200"><?php echo $PartName ;?></td>    
<td width="100"><?php echo $row->category_name; ?></td> 
<td align="center" width="30" ><?php echo $row->BalMat ; ?></td>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_list_master").DataTable(); });</script>