<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>DocNum</th>  
    <th>Product</th>
    <th>Cust</th>  
    <th>Spec</th> 
    <th>Qty</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($list as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih2('<?php echo $row->DocNumDetail;?>')">
<td align="left" width="60" ><?php echo $row->DocNumDetail ; ?></td>
<td width="200"><?php echo $PartNo ;?><br /><?php echo $PartName ;?></td>         
<td align="2" width="70" ><?php echo $row->Code ; ?></td>
<td width="100"><?php echo $row->Spec2 ; ?></td> 
<td align="center" width="30" ><?php echo $row->BalMat ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>
<script> $(function () { $("#t_list_master").DataTable(); });</script>