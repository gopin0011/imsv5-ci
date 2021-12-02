<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th> 
    <th width="10%">DocDate</th>
    <th width="34%">Product</th>
    <th width="8%">Customer</th>
    <th width="10%">Total</th>
    <th width="10%">NG</th>
    <?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
    <th width="10%"></th>
    <?php } ?> 
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$total = $row->QtyMat;
 $tgl = $this->app_model->tgl_str($row->DocDate);
 $cust = $row->Code;
 $NGSheet = $row->NGMatSheet ;
 $NGCoil = $row->NGMatCoil ;
 $NG = $NGSheet + $NGCoil ;
 $OK = $total - $NG;
 $PartName = substr($row->PartName,0,25) ;
 $MaterialType = $row->MaterialType ;
 if($MaterialType==2){ $UOM = 'Sht' ; } ;
 if($MaterialType==1){ $UOM = 'Kg' ; } ;
 $DocNumDetail = $row->DocNumDetail ;
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 $QtyMat =  $row->QtyMat ; 
 $NGMatSheet =  $row->NGMatSheet ;
 $NGMatCoil =  $row->NGMatCoil ;
 $NGMat = $NGMatSheet + $NGMatCoil ;
?>
<tr>
 <td align="left"><?php echo $no; ?></td>
 <td align="left"><?php echo $row->DocNumDetail; ?><br /><?php echo $row->CreateBy; ?></td> 
 <td align="left"><?php echo $tgl ; ?><br /><?php echo $row->DocTime; ?></td>
 <td ><?php echo $row->PartNo ; ?><br /><?php echo $PartName ; ?><br /> <?php echo $row->Spec2; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="right"><?php echo number_format($OK); ?></td>
 <td align="right"><?php echo number_format($NG); ?></td>
 <td align="center" width="40">
<?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
 <?php  $cek2 = $this->Role_Model->TrcMaterialUp(); if(!empty($cek2)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a><?php } ?>
 <?php  $cek3 = $this->Role_Model->TrcMaterialDel(); if(!empty($cek3)){ ?>
 <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>','<?php echo $PartNo ; ?>','<?php echo $QtyMat ; ?>','<?php echo $row->QtyPcs ; ?>','<?php echo $row->BalMatSource ; ?>','<?php echo $row->BalPcsSource ; ?>','<?php echo $row->CanEdit ; ?>','<?php echo $row->SourceDocNum ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 <?php } ?> <?php } ?> 
 <a style="CURSOR: pointer; COLOR: #ff0000" 
 onclick="window.open(&#39;<?php echo base_url();?>index.php/OUTMaterial/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a> </td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />
<script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>