<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
    <th>Reg</th> 
    <th>Product</th>
    <th>Customer</th>
    <th>NG</th>
    <th>Total</th>
    <th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $QtyMat =  $row->QtyMat ; 
 $NGMatSheet =  $row->NGMatSheet ;
 $NGMatCoil =  $row->NGMatCoil ;
 $NGMat = $NGMatSheet + $NGMatCoil ;
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 $MatNum =  $row->MatNum;
 $DocNum = $row->DocNum;
 $DocNumDetail = $row->DocNumDetail;
?>
<tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td align="left" width="40"><?php echo $row->DocNumDetail ; ?>  </td>
 <td width="250"><?php echo $PartNo ; ?>
 <br /> <?php echo $PartName ; ?></td>
 <td align="left" width="40" ><?php echo $row->Code; ?></td>
 <td align="right" width="20" ><?php echo number_format($NGMat); ?></td>
 <td align="right" width="20" ><?php echo number_format($QtyMat); ?></td>
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
 <i class="glyphicon glyphicon-print"></i></a>
 </td>
</tr>
<?php endforeach;?>
</tbody>
</table>




<script> $(function () { $("#t_transaction_detail").DataTable(); });</script>