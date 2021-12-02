<script type="text/javascript">
$(document).ready(function(){
$("#tutup").click(function(){
 window.close();
 return false();
 });
 
$("#HapusDetail").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 var CanEditDelete         = $("#CanEditDelete").val();
 if(CanEditDelete>0){ 
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
      
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/INMaterial/Hapus_Transaksi",
 data	: "DocNumDetailDelete="+DocNumDetailDelete,
 cache	: false,
 success	: function(data){
setTimeout(function(){   
 $("#myModal_Success").modal('show');
 $("#pesanSuccess").text(data);
 },300) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Server tidak merespon :'+kesalahan); } }); return false(); });
 
$("#HapusDetailOut").click(function(){
    var DocNumDetailDelete	    = $("#DocNumDetailDeleteOut").val();
    var CanEditDelete         = $("#CanEditDeleteOut").val();
    var QtyMatDelete         = $("#QtyMatDelete").val();
    var QtyPcsDelete         = $("#QtyPcsDelete").val();
    var DocNum_ExtDelete         = $("#DocNum_ExtDelete").val();
    
if(CanEditDeleteOut>0){ 
    $("#myModal_Fail").modal('show');
    $("#pesanFail").text('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
    
$("#myModalDeleteOut").modal('hide');  
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/OUTMaterial/Hapus_Detail",
data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&CanEditDelete="+CanEditDelete+"&QtyMatDelete="+QtyMatDelete+"&QtyPcsDelete="+QtyPcsDelete+"&DocNum_ExtDelete="+DocNum_ExtDelete,
cache	: false,
success	: function(data){
setTimeout(function(){
 $("#myModal_Success").modal('show');
 $("#pesanSuccess").text(data); },300) },
error : function(xhr, teksStatus, kesalahan) {
$("#myModal_Fail").modal('show');
$("#pesanFail").text('Server tidak merespon :'+kesalahan); } 	}); return false();	 });
 
});	
</script>
<div class="box-body">
<div class="box">
<div class="box-body">

<form hidden="" name="form" id="form">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse">
<div class="panel-body">
    
<div class="col-md-6">        
<div class="form-group">
<label class="col-lg-4 control-label">ID</label>
<div class="col-lg-8">
<input type="text" id="ItemID" name="ItemID"  class="form-control" value="<?php echo $ItemID ;?>" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-8">
<input type="text" id="PartNo" name="PartNo"  class="form-control" value="<?php echo $PartNo ;?>" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartName" name="PartName"  class="form-control" value="<?php echo $PartName ;?>" readonly="readonly">
</div> </div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Customer</label>
<div class="col-lg-8">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly" value="<?php echo $CustName ;?>">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Stock Material</label>
<div class="col-lg-8">
<input type="text" id="Stock" name="Stock"  class="form-control" value="<?php echo $Stock ;?>" readonly="readonly">
</div></div> 
</div>
</div></div></div></div></form>
 <div class="box-body panel-footer">
 <div class="box-tools pull-left" data-toggle="tooltip">
 <div class="btn-group" data-toggle="btn-toggle"> 
<a id="reloaded" href="<?php echo base_url();?>index.php/ReportMaterial/DataRecord/<?php echo $ItemID ;?>" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
<button type="button" name="tutup" id="tutup" class="btn btn-primary"><i class="fa fa-reply"></i> Closed</button>
</div></div></div>

<br />

<div class="panel-group" id="accordion">                            
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#INMaterialMPC"><span class="glyphicon ">
</span>  Material Masuk &nbsp; 
 <span style="float: right;"><i class="fa fa-bars"></i></span></a>  </h5> 
</div>
<div id="INMaterialMPC" class="collapse in">
<div class="panel-body">
<div class="dataTable_wrapper">
<table id="t_transaction_detail_report_in" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>KODE</th>
    <th>Product</th>
    <th>Customer</th> 
    <th>Qty</th>
    <th>Balance</th>
    <th></th>
    
</tr>
</thead>
<tbody>
<?php
	if($num_in>0){
		$g_total=0;
		$no =1;
		foreach($list_in as $db){  
	    $QtyMat =  $db->QtyMat  ;  
        $BalMat =  $db->BalMat  ;  
        $PartNo =  substr($db->PartNo ,0,15);
        $PartName =  $db->PartName ;
         $MatNum =  $db->MatNum ;
         $DocNum = md5($db->DocNum ) ;
         $DocNumDetail = $db->DocNumDetail  ;
         $DocNumDetail2 = $db->DocNumDetail  ;
         $DocNumDetailCek = substr($db->DocNumDetail ,0,-12) ;
		?>    
<tr class="odd gradeX">
			<td align="left" width="20"><?php echo $no; ?></td>
            <td align="left" width="50"><?php echo $DocNumDetail2 ; ?> 
			<td width="200"><?php echo $PartNo ; ?>
            <br /> <?php echo $PartName ; ?></td>
            <td align="left" width="60" ><?php echo $db->Code ; ?></td> 
            <td align="left" width="20" ><?php echo number_format($QtyMat); ?></td>
            <td align="left" width="20" ><?php echo number_format($BalMat); ?></td>
            <td align="center" width="30">
            
            <?php  $cek = $db->CanEdit ; if($cek == '0'){ ?>
            <?php  $cek = $this->session->userdata('CanEditDocAdmin')=='1'; if(!empty($cek)){ ?>
            <i style="cursor:pointer" class="glyphicon glyphicon-edit" target="popup" onclick="window.open('<?php echo base_url(); ?>index.php/ReportMaterial/EditINM/<?php echo $DocNumDetail2 ;?>','name','width=1200,height=600')"></i>
             <a onfocus="PilihHapusIn('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
            <?php } ?><?php } ?>
            <a style="CURSOR: pointer; COLOR: #ff0000" 
            onclick="window.open(&#39;<?php echo base_url();?>index.php/INMaterial/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
			<i class="glyphicon glyphicon-print"></i></a>
            
            
            </td></tr>
<?php $no++; } }  ?>
</tbody></table></div></div></div></div></div></div></div>

<div class="panel-group" id="accordion">                            
<div class="row">
<div class="col-lg-12">
<div class="panel panel-success">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#OUTMaterialMPC"><span class="glyphicon ">
</span>  Material Keluar &nbsp; 
 <span style="float: right;"><i class="fa fa-bars"></i></span></a>  </h5> 
</div>
<div id="OUTMaterialMPC" class="collapse in">
<div class="panel-body">
<div class="dataTable_wrapper">
<table id="t_transaction_detail_report_out" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>KODE</th>
    <th>Product</th>
    <th>Customer</th> 
    <th>Qty</th>
    <th>Balance</th>
    <th></th>
    
</tr>
</thead>
<tbody>
<?php
	if($num_out>0){
		$g_total=0;
		$no =1;
		foreach($list_out as $db){  
	    $QtyMat =  $db->QtyMat  ;  
        $BalMat =  $db->BalMat  ;
        $PartNo =  substr($db->PartNo ,0,15);
        $PartName =  $db->PartName ;
         $MatNum =  $db->MatNum ;
         $DocNum = md5($db->DocNum ) ;
         $DocNumDetail = $db->DocNumDetail  ;
         $DocNumDetail2 = $db->DocNumDetail  ;
		?>    
<tr class="odd gradeX">
			<td align="left" width="20"><?php echo $no; ?></td>
            <td align="left" width="50"><?php echo $db->SourceDocNum  ; ?> - IN<br /><?php echo $db->DocNumDetail  ; ?> - OUT</td>
			<td width="200"><?php echo $PartNo ; ?>
            <br /> <?php echo $PartName ; ?></td>
            <td align="left" width="60" ><?php echo $db->Code ; ?></td> 
            <td align="left" width="20" ><?php echo number_format($QtyMat); ?></td>
            <td align="left" width="20" ><?php echo number_format($BalMat); ?></td>
            <td align="center" width="30">
            <?php  $cek = $db->CanEdit =='0'; if(!empty($cek)){ ?>
             <?php  $cek = $this->session->userdata('CanEditDocAdmin')=='1'; if(!empty($cek)){ ?>
             <i style="cursor:pointer" class="glyphicon glyphicon-edit" target="popup" onclick="window.open('<?php echo base_url(); ?>index.php/ReportMaterial/EditOUTM/<?php echo $DocNumDetail2 ;?>','name','width=1200,height=600')"></i>
              <a onfocus="PilihHapusOut('<?php echo $DocNumDetail ; ?>','<?php echo $PartNo ; ?>','<?php echo $QtyMat ; ?>','<?php echo $db->QtyPcs ; ?>','<?php echo $db->BalMatSource ; ?>','<?php echo $db->BalPcsSource ; ?>','<?php echo $db->CanEdit ; ?>','<?php echo $db->SourceDocNum ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
             <?php } ?><?php } ?>
            <a style="CURSOR: pointer; COLOR: #ff0000" 
            onclick="window.open(&#39;<?php echo base_url();?>index.php/OutMaterial/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
			<i class="glyphicon glyphicon-print"></i></a>
            
            </td></tr>
<?php $no++; } }  ?>
</tbody> </table> </div> </div> </div> </div> </div></div> </div>


<div class="panel-group" id="accordion">                            
<div class="row">
<div class="col-lg-12">
<div class="panel panel-info">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#ReturnMaterialMPC"><span class="glyphicon ">
</span>  Material Kembali &nbsp; 
 <span style="float: right;"><i class="fa fa-bars"></i></span></a>  </h5> 
</div>
<div id="ReturnMaterialMPC" class="collapse in">
<div class="panel-body">
<div class="dataTable_wrapper">
<table id="t_transaction_detail_report_ret" class="table table-bordered table-striped">
<thead>
<tr class="headings">
	<th>No</th>
    <th>KODE</th>
    <th>Product</th>
    <th>Customer</th> 
    <th>Qty</th>
    <th>Balance</th>
    <th></th>
    
</tr>
</thead>
<tbody>
<?php
	if($num_ret>0){
		$g_total=0;
		$no =1;
		foreach($list_ret as $db){  
	    $QtyMat =  $db->QtyMat  ;  
        $NGMat =  $db->NGMatSheet  ;  
        $BalMat =  $db->BalMat  ;        
        $PartNo =  substr($db->PartNo ,0,15);
        $PartName =  $db->PartName ;
         $MatNum =  $db->MatNum ;
         $DocNum = md5($db->DocNum ) ;
         $DocNumDetail = $db->DocNumDetail  ;
         $DocNumDetail2 = $db->DocNumDetail  ;
         
         $CanEdit1 = $QtyMat - ($BalMat +  $NGMat)  ;  
		?>    
<tr class="odd gradeX">
			<td align="left" width="20"><?php echo $no; ?></td>
            <td align="left" width="50"><?php echo $db->SourceDocNum  ; ?> - IN<br /><?php echo $db->DocNumDetail  ; ?> - OUT</td>
			<td width="200"><?php echo $PartNo ; ?>
            <br /> <?php echo $PartName ; ?></td>
            <td align="left" width="60" ><?php echo $db->Code ; ?></td> 
            <td align="left" width="20" ><?php echo number_format($QtyMat); ?></td>
            <td align="left" width="20" ><?php echo number_format($BalMat); ?></td>
            <td align="center" width="30">
            <?php  $cek = $CanEdit1=='0'; if(!empty($cek)){ ?>
            <?php  $cek = $this->session->userdata('CanEditDocAdmin')=='1'; if(!empty($cek)){ ?>
            <i style="cursor:pointer" class="glyphicon glyphicon-edit" target="popup" onclick="window.open('<?php echo base_url(); ?>index.php/ReportMaterial/EditReturn/<?php echo $DocNumDetail2 ;?>','name','width=1200,height=600')"></i>
            <a onfocus="PilihHapusOut('<?php echo $DocNumDetail ; ?>','<?php echo $PartNo ; ?>','<?php echo $QtyMat ; ?>','<?php echo $db->QtyPcs ; ?>','<?php echo $db->BalMatSource ; ?>','<?php echo $db->BalPcsSource ; ?>','<?php echo $db->CanEdit ; ?>','<?php echo $db->SourceDocNum ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
            <?php } ?><?php } ?>
            <a style="CURSOR: pointer; COLOR: #ff0000" 
            onclick="window.open(&#39;<?php echo base_url();?>index.php/ReturnMaterial/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
			<i class="glyphicon glyphicon-print"></i></a>
            
            </td></tr>
<?php $no++; } }  ?>
</tbody> </table> </div> </div> </div> </div> </div></div> </div>

</div></div></div>

<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete"></div>
<br /><br /><br />
<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<button type="button" name="HapusDetail" id="HapusDetail" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
<form class="navbar-right" role="search">
<div class="form-group">
<input hidden="true" type="text" id="CanEditDelete" name="CanEditDelete" readonly="true" >
<input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
</form>
</div>
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModalDeleteOut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>             
<div id="pesanOut"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDeleteOut"></div>
<br /><br /><br />
<div class="panel-footer">
 <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
 <button type="button" name="HapusDetailOut" id="HapusDetailOut" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
 <form class="navbar-right" role="search">
 <div class="form-group">
 <input hidden="true" type="text" id="CanEditDeleteOut" name="CanEditDeleteOut" readonly="true" >
 <input hidden="true" type="text" id="QtyMatDelete" name="QtyMatDelete" readonly="true" >
 <input hidden="true" type="text" id="QtyPcsDelete" name="QtyPcsDelete" readonly="true" >
 <input hidden="true" type="text" id="DocNum_ExtDelete" name="DocNum_ExtDelete" readonly="true" >
 <input type="text" id="DocNumDetailDeleteOut" name="DocNumDetailDeleteOut" class="form-control" readonly="true" ></div>
 </form>
 </div>
 </div></div></div></div></div>
 

<div class="modal fade" id="myModal_Success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Success.png" /> Info</h4></div><div class="modal-body"><div>                  
<div id="pesanSuccess"></div>  
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModal_Fail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Warning.png" /> Info</h4></div><div class="modal-body"><div>
                        
<div id="pesanFail"></div>


    
</div></div></div></div></div><!-- /.modal -->

<script type="text/javascript"> 
function PilihHapusIn(DocNumDetail,PartNo,CanEdit){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
$("#CanEditDelete").val(CanEdit);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
<script type="text/javascript"> 
function PilihHapusOut(DocNumDetail,PartNo,QtyMat,QtyPcs,BalMatSource,BalPcsSource,CanEditDelete,DocNum_Ext){
var BalMatSourceX = parseFloat(QtyMat) + parseFloat(BalMatSource) ;
var BalPcsSourceX = parseFloat(QtyPcs) + parseFloat(BalPcsSource) ;
$("#myModalDeleteOut").modal('show');
$("#DocNumDetailDeleteOut").val(DocNumDetail);
$("#CanEditDeleteOut").val(CanEditDelete);
$("#QtyMatDelete").val(BalMatSourceX);
$("#QtyPcsDelete").val(BalPcsSourceX);
$("#DocNum_ExtDelete").val(DocNum_Ext);
$("#pesanOut").text("Anda yakin menghapus bro ?");
$("#PartNoDeleteOut").text(PartNo);  };
</script>

<script> $(function () { $("#t_transaction_detail_report_in").DataTable(); });</script>
<script> $(function () { $("#t_transaction_detail_report_out").DataTable(); });</script>
<script> $(function () { $("#t_transaction_detail_report_ret").DataTable(); });</script>
    