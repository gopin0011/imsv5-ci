<!-- start DetailMatIn2.view -->

<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Part Name</th>
<th>Specs</th>
<th>Remark</th>
<th>Qty</th>
<th>UoM</th>
<!--<th></th>-->
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $QtyMat =  $row->Quantity ;  
 $CreateID =  $row->CreateByID ;  
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 //$MatNum =  $row->MatNum;
 //$DocNum = md5($row->DocNum) ;
 //$DocNumDetail = $row->DocNumDetail ;
 $StockFG = $this->app_model->CariStockFG($row->ItemID) ;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="200"><?php echo $PartName ; ?></td>
 <td align="left" width="60" ><?php echo $row->JobNumber; ?></td>
 <td align="left" width="60" ><?php echo $row->OrderReference; ?></td>  
 <td align="right" width="20" ><?php echo number_format($QtyMat); ?></td>
 <td align="left" width="60" ><?php echo $row->unit; ?></td>
 <!--
 <td align="center" width="60">
 <a onfocus="PilihEdit('<?php echo $row->RegID ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a> 
 <a onfocus="PilihHapus('<?php echo $row->RegID ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 </td>-->
 </tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>

<!-- end DetailMatIn2.view -->