<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Reg</th>
<th>DocDate</th>
<th>Product</th>
<th>Customer</th>
<th>Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$total = $row->BalMat ;
$tgl = $this->app_model->tgl_str($row->DocDate);
$CreateDate = $this->app_model->tgl_str($row->CreateDate);
$cust = $row->Code;
$supp = $row->partner_code ;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = md5($row->DocNumDetail) ;
$DocNumDetail1 = $row->DocNumDetail ;
$PartName = substr($row->PartName,0,25) ;
$MaterialType = $row->MaterialType ; if($MaterialType==2){ $UOM = 'Sht' ; } ;
if($MaterialType==1){ $UOM = 'Kg' ; } ;
?>
<tr>
<td align="left"><?php echo $no ; ?></td> 
<td align="left"><?php echo $row->CreateBy; ?><br /><?php echo $row->DocNumDetail; ?></td>
<td align="left"><?php echo $tgl ; ?><br /><?php echo $row->DocTime ; ?></td>
<td ><?php echo $row->PartNo ; ?><br /><?php echo $PartName ; ?><br /> <?php echo $row->Spec1 .' '. $row->Spec2 ;?></td>
<td align="left"><?php echo $cust; ?></td>
<td align="left"><?php echo number_format($row->BalMat); ?> <?php echo $UOM ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<script> $(function () { $("#t_transaction_detail").DataTable(); });</script>