<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr>
	<th>No</th>
    <th>Product</th>
    <th>Customer</th>
    <th>Line</th>
    <th>Plan</th>
    <th>Act</th>
    <th>NG</th>
    <th>Remark</th>
    <th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $Qty =  $row->Yield ; 
 $NG =  $row->NG ; 
 $PartNo =  $row->PartNo;
 $PartName =  $row->PartName; 
 $DocNum = $row->DocNum ;
 $DocNumDetail = $row->DocNumDetail ;
 $DocNumDetail2 = md5($row->DocNumDetail) ;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td> 
 <td width="200"><?php echo $PartNo ; ?>
 <br /> <?php echo $PartName ; ?></td>
 <td align="left" width="30" ><?php echo $row->CustName; ?></td> 
 <td align="left" width="30" ><?php echo $row->Line; ?> - <?php echo $row->IDLineDetail; ?></td> 
 <td align="left" width="20" ><?php echo number_format($row->QtyPlan); ?></td>
 <td align="left" width="20" ><?php echo number_format($row->Qty); ?></td>
 <td align="left" width="20" ><?php echo number_format($NG); ?></td>
 <td align="left" width="40" ><?php echo $row->ProsesD; ?> / <?php echo $row->ProsesH; ?> <?php echo $row->Status; ?></td> 
 <td align="center" width="40">
<?php  $cek = $this->Role_Model->TrcStampingUp(); if(!empty($cek)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i></a><?php } ?>
 <?php  $cek2 = $this->Role_Model->TrcStampingDel(); if(!empty($cek2)){ ?>
 <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 <?php } ?>
 <a style="CURSOR: pointer; COLOR: #ff0000"
 onclick="window.open(&#39;<?php echo base_url();?>index.php/OutSTP/PrintLabel/<?php echo $DocNumDetail2 ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a>
 </td>
 </tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>