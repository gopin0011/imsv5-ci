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
 $("#ItemID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); 	}); 
 $("#ItemID").click(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
 $("#ItemID").keyup(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
 $("#ItemID").keydown(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
 $("#empty").click(function(){
 $("#ItemID3").val(""); 
 $("#part_no").val("");  });

$("#Qty").focus(function(){
 var  Qty = $("#Qty").val();  
 if(Qty == 0){ $("#Qty").val(""); hitung();
 return false(); }  }); $("#Qty").focusout(function(){ var  Qty = $("#Qty").val(); 
 if(Qty.length==0){ $("#Qty").val("0"); hitung(); return false(); }  });
        
function CariProfilProduct(){
var kode = $("#ItemID").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
data	: "kode="+kode,
cache	: false,
dataType : "json",
success	: function(data){
 $("#PartNo").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#IDCust").val(data.IDCust);
 $("#CustName").val(data.CustName2);
 $("#PcsPerDay").val(data.PcsPerday);
 $("#StdPack").val(data.StdPack);
 $("#StockFG").val(data.StockFG);
 $("#StockFG2").val(data.StockFG);
 $("#Stock").val(data.StockFG);
 $("#IsActive").val(data.IsActive);
 $("#Qty").val("0");   }  });  };

$("#ItemID3").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); 	}); 
$("#ItemID3").click(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); });
$("#ItemID3").keyup(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); });
$("#ItemID3").keydown(function(e){ var isi = $(e.target).val(); CariProfilProduct2(); });

$("#ItemID22").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct3(); 	}); 
$("#ItemID22").click(function(e){ var isi = $(e.target).val(); CariProfilProduct3(); });
$("#ItemID22").keyup(function(e){ var isi = $(e.target).val(); CariProfilProduct3(); });
$("#ItemID22").keydown(function(e){ var isi = $(e.target).val(); CariProfilProduct3(); });

$("#spec").focus(function(){ var  spec = $("#spec").val();
 if(spec == 'All'){ $("#spec").val(""); return false(); }  });
        
$("#spec").focusout(function(){
 var spec = $("#spec").val();
 if(spec.length==0){
 $("#spec").val("All");
 return false(); }  });

function CariProfilProduct2(){
 var kode = $("#ItemID3").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#part_no").val(data.PartNo);
   }  });  };
     
function CariProfilProduct3(){
 var kode = $("#ItemID22").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#PartNo22").val(data.PartNo);
 $("#PartName22").val(data.PartName);
 $("#CustName22").val(data.CustName);   }  });  };

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList(); });

$('#Reload3').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList2(); });
            
function MasterList(){
 var kode = $("#IDCust").val();
 $("#MasterList").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ReportFinishGood/MasterList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };

function MasterList2(){
 var kode = $("#IDCust").val();
 $("#MasterList2").html("");
 $('#Reload3').button('loading');
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ReportFinishGood/MasterList2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload3').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList2").html(data); }, 700); } }); };


$("#SubmitSearch").click(function(){
var DocDateReport_1 = $("#DocDateReport_1").val();
var DocDateReport_2 = $("#DocDateReport_2").val();
var $this = $(this);
var IDCust = $("#IDCust").val();
var ItemID = $("#ItemID3").val();
var string = "DocDateReport_1="+DocDateReport_1+"&DocDateReport_2="+DocDateReport_2+"&IDCust="+IDCust+"&ItemID="+ItemID;
if(DocDateReport_1.length==0){
$("#myModal2").modal('show');
$("#pesan").text('Tanggal tidak boleh kosong'); return false(); }

if(DocDateReport_2.length==0){
$("#myModal2").modal('show');
$("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 

$this.button('loading');
$("#transaction_detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/ReportFinishGood/ReadReport",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
$this.button('reset');
$("#transaction_detail_report").html(data); },1000) }	 });
 return false();	 });
    
$("#Export").click(function(){
 var DocDateReport_1 = $("#DocDateReport_1").val();
 var DocDateReport_2 = $("#DocDateReport_2").val();
 var IDCust = $("#IDCust").val();
 var ItemID = $("#ItemID3").val();
 
 var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust+"/"+ItemID;
 if(DocDateReport_1.length == 0){
    $("#myModal2").modal('show');
    $("#pesan").text('Tanggal tidak boleh kosong');
	return false(); }
 if(DocDateReport_2.length == 0){
    $("#myModal2").modal('show');
    $("#pesan").text('Tanggal tidak boleh kosong');
	return false(); } 
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
	waitingDialog3.hide();
    window.open('<?php echo site_url();?>/ReportFinishGood/ExportReport/'+string);
	},1000)       
	return false(); });    

$("#SubmitStockCard").click(function(){
var PartNo = $("#PartNo22").val();
var ItemID = $("#ItemID22").val();
var DocDateReport1 = $("#DocDateReport1").val();
var DocDateReport2 = $("#DocDateReport2").val();

var string = "DocDateReport1="+DocDateReport1+"&DocDateReport2="+DocDateReport2+"&ItemID="+ItemID;
if(DocDateReport1.length == 0){
$("#myModal4").modal('show');
$("#pesan4").text('Tanggal tidak boleh kosong');
return false(); }

if(DocDateReport2.length == 0){
$("#myModal4").modal('show');
$("#pesan4").text('Tanggal tidak boleh kosong');
$("#DocDateReport_2").focus();
return false(); }
         
if(PartNo.length == 0){
$("#myModal4").modal('show');
$("#pesan4").text('Part No harus diisi');
return false(); }

var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
$("#tampil_stock_card").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/ReportFinishGood/ReadStockCard",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#tampil_stock_card").html(data);
},2000) } }); return false(); });

$("#Save").click(function(){
 var PartNo	    = $("#PartNo").val();
 var PartName	= $("#PartName").val();
 var ItemID	    = $("#ItemID").val();
 var string = $("#form3").serialize();
 if(PartNo.length==0){ $("#myModal4").modal('show'); $("#pesan4").text('Part No Harus di isi');  return false(); } 
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ReportFinishGood/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 var win = $("#myModal2").modal('show');
 $("#pesan").text(data);
 setTimeout(function(){
 $("#myModal2").modal('hide');
 BackHome (); },2000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false(); 	});
             
$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#ItemID3").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); });
$("#part_no").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); }); 

$("#ItemID22").click(function(){ $("#myModal_MaterialList2").modal('show'); MasterList2(); });
$("#PartNo22").click(function(){ $("#myModal_MaterialList2").modal('show'); MasterList2(); });      
    
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
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust" name="IDCust" class="form-control" style="width: 100%;">

<?php foreach($l_cust->result() as $t){  ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } ?>
<option value="All">All</option>  
</select>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-3">
<input type="text" id="ItemID3" name="ItemID3"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="part_no" name="part_no"  class="form-control" readonly="true" >
</div><button type="button" name="empty" id="empty" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label style="text-align: left;" class="col-xs-4 control-label">1.&nbsp; Stock < 1</label>
<label style="text-align: left;" class="col-xs-4 control-label">: <strong>Danger</strong></label>
<label style="text-align: left;" class="col-xs-4 control-label">
<img style="height: 20px; width: 20px;" src="<?php echo base_url(); ?>images/INDOKATOR/Danger.gif"/>
</label>
</div>

<div class="form-group">
<label style="text-align: left;" class="col-xs-4 control-label">2.&nbsp; 1 <strong>&#8804;</strong> Stock <strong>&#60;</strong> 2 </label>
<label style="text-align: left;" class="col-xs-4 control-label">: <strong>Warning</strong></label>
<label style="text-align: left;" class="col-xs-4 control-label">
<img style="height: 20px; width: 20px;" src="<?php echo base_url(); ?>images/INDOKATOR/Warning.gif"/>
</label>
</div>

<div class="form-group">
<label style="text-align: left;" class="col-xs-4 control-label">3.&nbsp; 2 <strong>&#8804;</strong> Stock <strong>&#8804;</strong> 3  </label>
<label style="text-align: left;" class="col-xs-4 control-label">: <strong>Safe</strong></label>
<label style="text-align: left;" class="col-xs-4 control-label">
<img style="height: 20px; width: 20px;" src="<?php echo base_url(); ?>images/INDOKATOR/Safe.gif"/>
</label>
</div>

<div class="form-group">
<label style="text-align: left;" class="col-xs-4 control-label">4.&nbsp; 3 <strong>&#60;</strong> Stock <strong>&#8804;</strong> 5 </label>
<label style="text-align: left;" class="col-xs-4 control-label">: <strong>Coution</strong></label>
<label style="text-align: left;" class="col-xs-4 control-label">
<img style="height: 20px; width: 20px;" src="<?php echo base_url(); ?>images/INDOKATOR/Coution1.gif"/>
</label>
</div>

<div class="form-group">
<label style="text-align: left;" class="col-xs-4 control-label">5.&nbsp; Stock <strong>&#62;</strong> 5 </label>
<label style="text-align: left;" class="col-xs-4 control-label">: <strong>Over</strong></label>
<label style="text-align: left;" class="col-xs-4 control-label">
<img style="height: 20px; width: 20px;" src="<?php echo base_url(); ?>images/INDOKATOR/Coution2.gif"/>
</label>
</div>

</div></div>
</div></div></div>

</form>


</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" class="btn btn-success" id="SubmitSearch" name="SubmitSearch" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-search"></i>&nbsp; Submit</button>
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

</div>


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
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-4">
<input type="text" id="ItemID22" name="ItemID22"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="PartNo22" name="PartNo22"  class="form-control" readonly="true">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName22" name="PartName22"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Cust</label>
<div class="col-xs-8">
<input type="text" id="CustName22" name="CustName22"  class="form-control" readonly="true">
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

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="FormEdit-tab">
<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal"  name="form3" id="form3">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi33" ><span  class="glyphicon ">
</span> Data Product <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="transaksi33" class="collapse in">
<div class="panel-body">

<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-4">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="true" >
</div>
<div class="col-lg-4">
<input type="text" id="PartNo" name="PartNo"  class="form-control" disabled="True">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartName" name="PartName"  class="form-control"  disabled="True">
</div></div> 

 <div class="form-group">
<label class="col-lg-4 control-label">Customer</label>
<div class="col-lg-8">
<input type="text" id="CustName" name="CustName"  class="form-control" disabled="True">
</div></div> 

  <div class="form-group">
<label class="col-lg-4 control-label">Need/Day</label>
<div class="col-lg-8">
<input type="text" id="PcsPerDay" name="PcsPerDay"  class="form-control" placeholder="Kebutuhan Per Hari">
</div>
</div> 
  <div class="form-group">
<label class="col-lg-4 control-label">Std Packing</label>
<div class="col-lg-8">
<input type="text" id="StdPack" name="StdPack" class="form-control" placeholder="Standart Packing">
</div>
</div> 

 
        
</div>
<div class="col-md-6">
 <div class="form-group">
<label class="col-lg-4 control-label">STO</label>
<div class="col-lg-4">
<input type="text" id="Qty" name="Qty"  class="form-control" placeholder="Reset Stock" value="0">
</div> 
<div class="col-lg-4">
<input type="text" id="Stock" name="Stock"  class="form-control"   readonly="true">
</div>
</div>
 <div class="form-group">
        <label class="col-lg-4 control-label">Status</label>
        <div class="col-lg-8">
            <select name="IsActive" id="IsActive" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="1">Active</option>
            <option value="0">Non Active</option>
    </select>
        </div>
        </div>
  <div class="form-group">
<label class="col-lg-4 control-label">Keterangan</label>
<div class="col-lg-8">
<textarea type="text" id="Remark" name="Remark"  class="form-control" value="STO" style="height: 100px;"> </textarea>
</div>  
</div>


</div>
</div></div></div></div></form>


</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Save" id="Save" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Update</button>
<a href="#tab_content1" id="home-tab2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-file-text-o"></i> Home</a>
</div></div></div></div></div>


</div></div></div>

</div></div>



<div class="modal fade" id="myModal_MaterialList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_MaterialList2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload3" name="Reload3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList2"></div>
</div> </div> </div> </div> </div> </div> </div>

<script>
  $(function () {
    //Initialize Select2 Elements
    $("#PartnerID").select2(); $("#PartnerID2").select2(); $("#IDCust").select2();
    $("#SysID").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

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

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script> 

<script> $(function () { $("#t_list_master").DataTable(); });</script>