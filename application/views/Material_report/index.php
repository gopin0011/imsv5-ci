<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    ion.sound({ sounds: [
    {name: "metal_plate"},
    {name: "water_droplet"}
            ],
    path: "<?php echo base_url(); ?>assets/sounds/",
    preload: true,
    volume: 1.0 });
    });
</script>
  
<script type="text/javascript">
$(document).ready(function(){

 $("#empty").click(function(){
 $("#ItemID").val(""); 
 $("#PartNo").val("");  });
 $("#BtnAll").click(function(){
 $("#SpecRM").val("All"); });

$("#SpecRM").focus(function(){ var  SpecRM = $("#SpecRM").val();
 if(SpecRM == 'All'){ $("#SpecRM").val(""); return false(); }  });
        
$("#SpecRM").focusout(function(){
 var  SpecRM = $("#SpecRM").val();
 if(SpecRM.length==0){
 $("#SpecRM").val("All"); 
 return false(); }  });
 
$("#SpecRM").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
     
 
 $("#PartNo2").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); }); 
 $("#PartNo2").click(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); });
function CariProfilProduct2(){
 var kode = $("#ItemID2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/Material_in/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#PartNo2").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#Spec2").val(data.SpecOrder);
 $("#CustName").val(data.CustName2);   }  });  };
            
function MasterList(){
var kode = $("#IDCust").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_report/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };

function MasterList2(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_report/MasterList2",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList2").html(data);	} }); };


$("#SubmitSearch").click(function(){
var ReportType = $("#ReportType").val();
if(ReportType==1){
var ItemID = $("#ItemID").val();

if(ItemID.length==0){
NotifFail('Part No tidak boleh kosong'); return true (); }
         
var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
$("#transaction_detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_report/ReadReport1",
data	: "&ItemID="+ItemID,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#transaction_detail_report").html(data); },1000) }	 });

}else{
var DocDateReport_1 = $("#DocDateReport_1").val();
var DocDateReport_2 = $("#DocDateReport_2").val();
var ItemID = $("#ItemID").val();
var SpecRM = $("#SpecRM").val();
var IDCust = $("#IDCust").val();
		
var string = "DocDateReport_1="+DocDateReport_1+"&DocDateReport_2="+DocDateReport_2+"&IDCust="+IDCust+"&ItemID="+ItemID+"&SpecRM="+SpecRM;
        
if(DocDateReport_1.length == 0){
NotifFail('Tanggal tidak boleh kosong'); return false(); }

if(DocDateReport_2.length == 0){
NotifFail('Tanggal tidak boleh kosong'); return false(); } 
         
var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
$("#transaction_detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_report/ReadReport2",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#transaction_detail_report").html(data); },1000) } }); } return false();	 });
    
$("#Export").click(function(){
    var ReportType = $("#ReportType").val();
    if(ReportType==1){
        
    var DocDateReport_1 = $("#DocDateReport_1").val();
	var DocDateReport_2 = $("#DocDateReport_2").val();
	var ItemID = $("#ItemID").val();
    
    var string = DocDateReport_1+"/"+DocDateReport_2+"/"+ItemID3+"/"+part_no;
    if(DocDateReport_1.length == 0){
NotifFail('Tanggal tidak boleh kosong');
	return false(); }
    if(DocDateReport_2.length == 0){
NotifFail('Tanggal tidak boleh kosong');
	return false(); } 
    if(part_no.length == 0){
NotifFail('Part No tidak boleh kosong');
    return true (); }
    var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
	waitingDialog3.hide();
    window.open('<?php echo site_url();?>/Material_report/ExportReport1/'+string);
	},1000)       
	}else{ 
 var DocDateReport_1 = $("#DocDateReport_1").val();
 var DocDateReport_2 = $("#DocDateReport_2").val();
 var ItemID = $("#ItemID").val();
 var SpecRM = $("#SpecRM").val();
 var IDCust = $("#IDCust").val();
    var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust+"/"+SpecRM+"/"+ItemID;
    if(DocDateReport_1.length == 0){
NotifFail('Tanggal tidak boleh kosong');
	return false(); }
    if(DocDateReport_2.length == 0){
NotifFail('Tanggal tidak boleh kosong');
	return false(); } 
    var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
	waitingDialog3.hide();
    window.open('<?php echo site_url();?>/Material_report/ExportReport2/'+string);
	},1000)  } return false(); });    


     function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'info',
        text: data,
        hide: true
      }); };
      
   function NotifFail(data){
        new PNotify({
        title: 'Info',
        type: 'error',
        text: data,
        hide: true
      }); }; 
      
       function NotifProses(data){
        new PNotify({
        title: 'Info',
        type: 'dark',
        text: data,
        hide: true
      }); };
      
$("#SubmitStockCard").click(function(){
var ItemID = $("#ItemID2").val();
var DocDateReport1 = $("#DocDateReport1").val();
var DocDateReport2 = $("#DocDateReport2").val();

var string = "DocDateReport1="+DocDateReport1+"&DocDateReport2="+DocDateReport2+"&ItemID="+ItemID;
if(DocDateReport1.length == 0){
NotifFail('Tanggal tidak boleh kosong');
return false(); }

if(DocDateReport2.length == 0){
NotifFail('Tanggal tidak boleh kosong');
$("#DocDateReport_2").focus();
return false(); }
         
if(ItemID.length == 0){
NotifFail('Part No harus diisi');
return false(); }

var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
$("#tampil_stock_card").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_report/ReadStockCard",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#tampil_stock_card").html(data);
},2000) } }); return false(); });
             
$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#ItemID").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); });
$("#PartNo").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); }); 

$("#ItemID2").click(function(){ $("#myModal_MaterialList2").modal('show'); MasterList2(); }); 
$("#PartNo2").click(function(){ $("#myModal_MaterialList2").modal('show'); MasterList2(); });      
    
});	
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal" name="form_id" id="form_id">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi3" ><span  class="glyphicon ">
</span> Properties&nbsp;
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="transaksi3" class="collapse in">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Start</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="DocDateReport_1" name="DocDateReport_1">
</div>             
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">End</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="DocDateReport_2" name="DocDateReport_2">
</div>              
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label blink" style="color: blue;">Report</label>
<div class="col-xs-8">
<select name="ReportType" id="ReportType" class="form-control">      
<option value="2" >Summary</option>
<option value="1" >Detail</option>
</select></div></div>

</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust" name="IDCust" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="All">All</option>
<?php } foreach($l_cust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } } ?>  
</select>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<input type="text" id="ItemID" name="ItemID" hidden=""  readonly="true">
<div class="col-xs-8">
<div class="input-group">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="true" >
<span class="input-group-btn">
<button type="button" name="empty" id="empty" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</span></div>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<div class="input-group">
<input type="text" id="SpecRM" name="SpecRM"  class="form-control" value="All">
<span class="input-group-btn">
<button type="button" name="BtnAll" id="BtnAll" class="btn btn-success"><i class="fa fa-refresh"></i></button></span></div></div>
</div>
</div></div></div></div>

</form>
</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="SubmitSearch" id="SubmitSearch" class="btn btn-success"><i class="fa fa-search"></i>&nbsp; Submit</button>
<button type="button" name="Export" id="Export" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>
<a href="#tab_content2" id="StockCard-tab" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-file-text-o"></i> Stock Card</a>
</div></div></div></div></div>
</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="transaction_detail_report"></div>
</div></div></div>

</div></div>


<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="StockCard-tab">
<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal"  name="form" id="form">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi2" ><span  class="glyphicon ">
</span> Stock Card <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="transaksi2" class="collapse in">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Start</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="DocDateReport1" name="DocDateReport1">
</div>             
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">End</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="DocDateReport2" name="DocDateReport2">
</div>              
</div>
</div>

    
</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>

<input type="text" id="ItemID2" name="ItemID2" hidden="">

<div class="col-lg-8">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" readonly="true" >
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Spec</label>
<div class="col-lg-8">
<input type="text" id="Spec2" name="Spec2"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Cust</label>
<div class="col-lg-8">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="true">
</div>
</div>
</div>
</div></div></div></div></form>

<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="SubmitStockCard" id="SubmitStockCard" class="btn btn-primary"><i class="fa fa-search"></i> Submit</button> 
<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-reply"></i> Back</a>
</div></div></div></div></div>

</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="tampil_stock_card"></div>
</div></div></div>
</div>

</div></div></div>

<div class="modal fade" id="myModal_MaterialList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_MaterialList2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList2"></div>
</div> </div> </div> </div> </div> </div> </div>

<script>
  $(function () {
    //Initialize Select2 Elements
    $("#PartnerID").select2(); $("#PartnerID2").select2(); $("#IDCust2").select2();
    $("#SysID").select2();

    //Date picker
    $('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#SJDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#DocDateReport_1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#DocDateReport_2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#DocDateReport1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#DocDateReport2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });

    
  });
</script> 

<script type="text/javascript"> 
 function SelectProduct(ItemID, id){
	$("#myModal_MaterialList").modal('hide');
	$("#ItemID").val(ItemID);
    $("#PartNo").val(id);
    
    }
</script>

    <script type="text/javascript"> 
function SelectProduct2(ItemID2){
	$("#myModal_MaterialList2").modal('hide');
	$("#ItemID2").val(ItemID2);
	$("#PartNo2").focus(); }
</script>
<script> $(function () { $("#t_list_master").DataTable(); });</script>