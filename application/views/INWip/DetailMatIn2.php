<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Part No</th>
<th>Part Name</th>
<th>Customer</th>
<th>Total</th>
<th>NG</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $QtyMat =  $row->QtyMat ; 
 $NG =  $row->NGPcsSheet ; 
 $CreateID =  $row->CreateByID ;  
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 $MatNum =  $row->MatNum;
 $DocNum = md5($row->DocNum) ;
 $DocNumDetail = $row->DocNumDetail ;
 $StockWIP = $this->app_model->CariStockWIP2($row->ItemID) ;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td align="left" width="150"><?php echo $PartNo ; ?></td>
 <td width="200"><?php echo $PartName ; ?></td>
 <td align="left" width="60" ><?php echo $row->Code; ?></td> 
 <td align="right" width="20" ><?php echo number_format($QtyMat); ?></td>
 <td align="right" width="20" ><?php echo number_format($NG); ?></td>
 <td align="center" width="60">
 <?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
<?php  $cek2 = $this->Role_Model->TrcWIPUp(); if(!empty($cek2)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a> 
 <?php  $cek3 = $this->Role_Model->TrcWIPDel(); if(!empty($cek3)){ ?>
 <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>', '<?php echo $StockWIP ; ?>', '<?php echo $row->ItemID ; ?>', '<?php echo $QtyMat ; ?>', '<?php echo $NG ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a><?php } ?>
 <?php } ?> <?php } ?> 
 </td>
 </tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>