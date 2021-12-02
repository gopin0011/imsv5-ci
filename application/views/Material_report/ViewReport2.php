<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
    <th>Product</th>
    <th>Cust</th> 
    <th>IN</th>
    <th>OUT</th>
    <th>RET</th>
    <th align="center">Bal</th>
    <th>Day</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$tgl_awal = $DocDateReport_1 ;
$tgl_akhir = $DocDateReport_2 ;
$tgl_pembanding = $DocDateReport_2 ;        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');

$tgl_sekarang	= date('d-m-Y');
$tgl_akhir_22	= strtotime('+1 day',strtotime($tgl_pembanding));
$tgl_akhir_23 = date('d-m-Y',$tgl_akhir_22 );
$tgl_sekarang2 = $this->app_model->tgl_sql($tgl_sekarang);
$tgl_akhir_2 = $this->app_model->tgl_sql($tgl_akhir_23);
$IN  = $this->app_model->QtyRM_IN_New($row->ItemID,$tgl_awal,$tgl_akhir);
$OUT  = $this->app_model->QtyRM_OUT_New($row->ItemID,$tgl_awal,$tgl_akhir);
$RET  = $this->app_model->QtyRM_RET_New($row->ItemID,$tgl_awal,$tgl_akhir);
$IN_2  = $this->app_model->QtyRM_IN_New($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
$OUT_2  = $this->app_model->QtyRM_OUT_New($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
$RET_2  = $this->app_model->QtyRM_RET_New($row->ItemID,$tgl_awal,$tgl_sekarang2);
$IN_F  = $this->app_model->QtyRM_IN_New($row->ItemID,$tgl_awal,$tgl_akhir);
$OUT_F  = $this->app_model->QtyRM_OUT_New($row->ItemID,$tgl_awal,$tgl_akhir);
$RET_F = $this->app_model->QtyRM_RET_New($row->ItemID,$tgl_awal,$tgl_akhir);
if($IN_F==0){$IN_R='-';}else{$IN_R= number_format($IN_F);}
if($OUT_F==0){$OUT_R='-';}else{$OUT_R= number_format($OUT_F);}
if($RET_F==0){$RET_R='-';}else{$RET_R= number_format($RET_F);}
if($tgl_pembanding == $tgl_sekarang){
$Stock = $row->BalMat;
}else{
$Stock2 = $row->BalMat;
$Stock = ($Stock2 - $IN_2) + $OUT_2  ;}       
$PartNo = substr($row->PartNo,0,20) ;
$PartName = substr($row->PartName,0,20) ;
$Spec2 = substr($row->Spec,0,12) ;
$StockPcs = $row->BalPcs;
$PcsPerDay = $row->PcsPerDay;
if($PcsPerDay == 0 ) { $StockDay = 0 ; }else{
$StockDay = $StockPcs / $PcsPerDay ;} ;  
if($StockDay<1){ $bar="images/INDOKATOR/Danger.gif"; }
if($StockDay>=1 && $StockDay<3){ $bar="images/INDOKATOR/Warning.gif"; }
if($StockDay>=3 && $StockDay<7){ $bar="images/INDOKATOR/Safe.gif"; }
if($StockDay>=7 && $StockDay<=10){ $bar="images/INDOKATOR/Coution1.gif"; }
if($StockDay>10){ $bar="images/INDOKATOR/Coution2.gif"; }

?>
<tr>
<td align="left" width="20"><?php echo $no; ?></td>
<td width="250" ><?php echo $PartNo ; ?><br /><?php echo $PartName ; ?><br />
<?php echo $row->SpecOrder1 .' '. $row->SpecOrder2 ; ?></td>
<td align="left" width="100" ><?php echo $row->CustName ; ?></td>
<td align="left" width="80" ><?php echo $IN_R ; ?> </td>
<td align="left" width="80" ><?php echo $OUT_R ; ?> </td>
<td align="left" width="80" ><?php echo $RET_R ; ?> </td>
<td align="left" width="80" ><?php echo number_format($Stock); ?> </td>
<td align="left" width="80" ><?php echo number_format($StockDay,2); ?> 
<img alt="Brand" style="height: 20px; width: 20px;" src="<?php echo base_url(); ?><?php echo $bar ; ?>"></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />
<script type="text/javascript"> 
function PilihEdit(id){
	$("#DocNumDetail2").val(id);
    $("#DocNumDetail").val(id.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,Qty_1,Qty_2,Qty_5,BalMat,BalPcs,CanEditDelete,DocNum_Ext){
var BalMatSource = parseFloat(Qty_1) + parseFloat(BalMat) + parseFloat(Qty_5) ;
var BalPcsSource = parseFloat(Qty_2) + parseFloat(BalPcs) + parseFloat(Qty_5) ;
$("#myModalDelete").modal('show');
$("#DocNumDetailDelete").val(DocNumDetail);
$("#CanEditDelete").val(CanEditDelete);
$("#QtyMatDelete").val(BalMatSource);
$("#QtyPcsDelete").val(BalPcsSource);
$("#DocNum_ExtDelete").val(DocNum_Ext);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
  
  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  
  
    
    <script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>