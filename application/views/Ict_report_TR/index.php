<!-- start index.view -->


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
    
    $("#ItemID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); 	}); 
    $("#ItemID").click(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
    $("#ItemID").keyup(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
    $("#ItemID").keydown(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });

    function CariProfilProduct()
    {
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
        $("#StockFG").val(data.StockWip);
        $("#StockFG2").val(data.StockFG);
        $("#Stock").val(data.StockFG);
        $("#IsActive").val(data.IsActive);
        $("#Qty").val("0");   }  });  
    };
 
    });
</script>
  
<script type="text/javascript">
$(document).ready(function(){
	$("#empty").click(function(){
      $("#ItemID").val(""); 
      $("#PartNo").val(""); 
      $("#PartName").val("");
      $("#Spec1").val("");
      $("#Unit").val("");
      $("#Category").val("");
	});


             
function MasterList(){
var kode = "" ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Ict_report_TR/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };



$("#SubmitSearch").click(function(){
 var tgl_1 = $("#tgl_1").val();
 var tgl_2 = $("#tgl_2").val();
 var IDCategory = $("#IDCategory").val();
 var part_no = $("#part_no").val();
 var spec = $("#spec").val();
 var string = "tgl_1="+tgl_1+"&tgl_2="+tgl_2+"&IDCategory="+IDCategory+"&part_no="+part_no+"&spec="+spec;
        
if(tgl_1.length==0){
$("#myModal2").modal('show');
$("#pesan").text('Tanggal tidak boleh kosong'); return false(); }

if(tgl_2.length==0){
$("#myModal2").modal('show');
$("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 

if(tgl_2<tgl_1){
 $("#myModal2").modal('show');
 $("#pesan").text('Cek Tanggal !!!'); return false();  } 
         
var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
$("#transaction_detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Ict_report_TR/ReadReport",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#transaction_detail_report").html(data); },1000) }	 });
return false();	 });
    
$("#Export").click(function(){
 var tgl_1 = $("#tgl_1").val();
 var tgl_2 = $("#tgl_2").val();
 var IDCategory = $("#IDCategory").val();
 var part_no = $("#part_no").val();
 var spec = $("#spec").val();
 var string = tgl_1+"/"+tgl_2+"/"+IDCategory+"/"+spec+"/"+part_no;
    
 if(tgl_1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }
 if(tgl_2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 
 if(tgl_2<tgl_1){
 $("#myModal2").modal('show');
 $("#pesan").text('Cek Tanggal !!!'); return false();  }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 waitingDialog3.hide();
 window.open('<?php echo site_url();?>/Ict_report_TR/ExportReport/'+string);
 },1000)       
 return false(); });    

$("#SubmitStockCard").click(function(){
 var IDCust = $("#IDCust").val();
 var PartNo = $("#PartName").val();
 var ItemID = $("#ItemID").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCust="+IDCust+"&tgl1="+tgl1+"&tgl2="+tgl2+"&ItemID="+ItemID;
if(tgl1.length == 0){
$("#myModal4").modal('show');
$("#pesan4").text('Tanggal tidak boleh kosong');
return false(); }

if(tgl2.length == 0){
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
url		: "<?php echo site_url(); ?>/Ict_report_TR/ReadStockCard",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
waitingDialog3.hide();
$("#tampil_stock_card").html(data);
},2000) } }); return false(); });
             
$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 

$("#ItemID").click(function(){ MasterList(); $("#myModal_MaterialList").modal('show');  }); 
$("#PartNo").click(function(){ MasterList(); $("#myModal_MaterialList").modal('show');  });      
    
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="tgl_1" name="tgl_1">
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="tgl_2" name="tgl_2">
</div>              
</div>
</div>


</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Category</label>
<div class="col-xs-8">
<select name="IDCategory" id="IDCategory" class="form-control">
<option value="semua">All Category</option>
<?php foreach($MListCategory->result() as $t){?>
<option value="<?php echo $t->id;?>"><?php echo $t->category_name;?></option>
<?php } ?></select>
</div></div> 
                
    <div class="form-group">
<label class="col-xs-4 control-label">Product</label>
<div class="col-xs-8">
<input type="text" id="part_no" name="part_no"  class="form-control" >
</div></div>

    <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<input type="text" id="spec" name="spec"  class="form-control">
</div></div>
</div></div>
</div></div></div>
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="tgl1" name="tgl1">
</div></div></div>

<div class="form-group">
<label class="col-xs-4 control-label">End</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="tgl2" name="tgl2">
</div></div></div>

</div>
<div class="col-md-6">
                
<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-3">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="true" >
</div><button type="button" name="empty" id="empty" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>

 <div class="form-group">
<label class="col-xs-4 control-label">Product Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-4">
<input type="text" id="Spec1" name="Spec1"  class="form-control" readonly="readonly">
</div> 
<div class="col-xs-4">
<input type="text" id="Unit" name="Unit"  class="form-control" readonly="readonly">
</div> 
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Category</label>
<div class="col-xs-8">
<input type="text" id="Category" name="Category"  class="form-control" readonly="readonly">
</div></div>
  
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


<script>
  $(function () {
    //Initialize Select2 Elements
    $("#PartnerID").select2(); $("#PartnerID2").select2(); $("#IDCust2").select2();
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

    $('#tgl_1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl_2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl2').datepicker({
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


<!-- end index.view -->