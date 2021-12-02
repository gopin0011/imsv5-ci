

<script>
function textAreaAdjust(o) {
    o.style.height = "55px";
    o.style.height = (22+o.scrollHeight)+"px";
    tampil_data();
}
</script>
<script>
function textAreaAdjustOut(o) {
o.style.height = "77px";
o.style.border.right = "none" ;
o.style.border.bottom = "none" ;
o.style.border.top = "none" ;
tampil_data();
}
</script>

<script>
function bigImg(x) {
    x.style.height = "21px";
    x.style.width = "21px";
}

function normalImg(x) {
    x.style.height = "20px";
    x.style.width = "20px";
}
</script>

<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th>
    <th width="10%">Supplier</th> 
    <th width="10%">DocDate</th>
    <th width="34%">Product</th>
    <th width="8%">Customer</th>
    <th width="10%">Qty</th>
    <th width="10%">Action</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$total = $row->Qty_1;
$tgl = $this->app_model->tgl_str($row->DocDate);
$CreateDate = $this->app_model->tgl_str($row->CreateDate);
$cust = $row->Code;
$supp = $row->partner_code ;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = md5($row->DocNumDetail) ;
$DocNumDetail1 = $row->DocNumDetail ;
$PartName = substr($row->PartName,0,25) ;
        
$MaterialType = $row->MaterialTypeID ;
if($MaterialType==2){ $UOM = 'Sht' ; } ;
if($MaterialType==1){ $UOM = 'Kg' ; } ;
?>
<tr>
<td align="left"><?php echo $no ; ?></td> 
<td align="left"><?php echo $row->DocNumDetail; ?><br /><?php echo $row->username; ?></td>
<td align="left"><?php echo $supp ; ?><br /><?php echo $row->DocNum_Ext; ?></td> 
<td align="left"><?php echo $tgl ; ?><br /><?php echo $CreateDate ; ?> <?php echo $row->DocTime ; ?></td>
<td ><?php echo $row->PartNo ; ?><br /><?php echo $PartName ; ?><br /> <?php echo $row->Spec .' '. $row->Thick .' X '. $row->Width .' X '. $row->Length  ; ?></td>
<td align="left"><?php echo $cust; ?></td>
<td align="left"><?php echo number_format($row->Qty_1); ?> <?php echo $UOM ; ?></td>
        
<td align="center" width="30">
<?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a onfocus="PilihEdit('<?php echo $DocNumDetail1 ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-edit"></i> </a>
<?php } ?> <?php } ?> 
<a style="CURSOR: pointer; COLOR: #ff0000" 
onclick="window.open(&#39;<?php echo base_url();?>index.php/Material_in/DetailPrint2/<?php echo $DocNumDetail1 ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
<i class="glyphicon glyphicon-print"></i></a>
</td></tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />
<script type="text/javascript"> 
function HapusDetail_2(SysID,PartNo){
    $("#DocNumDetailDelete2").val(SysID);
     $("#myModalDelete2").modal('show');
     $("#pesan2").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete2").text(PartNo); 
	};
    </script>

<script type="text/javascript"> 
function PilihEditHead(ItemID, DocNum, DocNumDetail, DocDate, PartName, QCCheckID, DocNum_Ext, DocNum_Ext_D, ShiftID, Qty_2){
	$("#SysID").val(ItemID);
    $("#DocNum").val(DocNum);
    
    var res = DocNumDetail.substr(11, 4);
    
    $("#DocNumDetail").val(res);
    $("#PartName").val(PartName);
    $("#QCCheckID").val(QCCheckID);
    $("#DocDate").val(DocDate);
    $("#RefNum").val(DocNum_Ext);
    $("#RefNum_D").val(DocNum_Ext_D);
    $("#ShiftID").val(ShiftID);
    $("#Qty_2").val(Qty_2);
    
   $('#'+DocNumDetail).on('click', function() {
    var $this = $(this);
  $this.button('loading');
  setTimeout(function() {
       $this.button('reset');
   }, 5000);
  });
    
    setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
                    
          setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
				},300) ;
				},500) 
			return false();
	 
    }
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
    <script> $(function () { $("#t_transaction_detail_stock").DataTable(); });</script>