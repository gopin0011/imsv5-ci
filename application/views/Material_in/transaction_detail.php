<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Log</th>
<th>Product</th>
<th>Customer</th>
<th>Qty</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->Qty_1 ;
$DocDate = $this->app_model->tgl_str($row->DocDate) ; 
$DocDate2 = $this->app_model->tgl_str($row->DocDate) ;
$CreateDate = $this->app_model->tgl_str($row->CreateDate) ; 
$PartNo =  substr($row->PartNo,0,25);
$PartName =  $row->PartName;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = $row->DocNumDetail ;
$MaterialTypeIDX = $row->MaterialTypeID ;
if($MaterialTypeIDX==1)
{$Uom = 'Kg';}else{$Uom = 'Sht';}

?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="left" width="40"><?php echo $row->DocNumDetail ; ?><br />
<?php echo $CreateDate ; ?> <?php echo $row->DocTime ; ?><br /><?php echo $row->DocNum_Ext ; ?></td>
<td align="left" width="200"><?php echo $PartNo ; ?><br /><?php echo $PartName ; ?></td>
<td align="left" width="20"><?php echo $row->Code .' - '. $row->ProjectName ; ?><br /></td>
<td align="left" width="20"><?php echo $Total ; ?> <?php echo $Uom ; ?></td>
<td align="center" width="10">
<?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
<?php $cek2 = $this->Role_Model->TrcMaterialUp(); if(!empty($cek2)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a> <?php } ?>
 <?php $cek3 = $this->Role_Model->TrcMaterialDel(); if(!empty($cek3)){ ?>
 <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>', '<?php echo $row->CanEdit ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 <?php } ?> <?php } ?> 
 <a style="CURSOR: pointer; COLOR: #ff0000" 
 onclick="window.open(&#39;<?php echo base_url();?>index.php/Material_in/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a>

</td>
</tr>
<?php endforeach;?>
</tbody>
</table>
    
<script> $(function () { $("#t_transaction_detail").DataTable(); });</script>