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
 $("#ItemIDReport").focus(function(e){ var isi = $(e.target).val(); CariProfilMachine(); 	}); 
 $("#ItemIDReport").click(function(e){ var isi = $(e.target).val(); CariProfilMachine(); });
 $("#ItemIDReport").keyup(function(e){ var isi = $(e.target).val(); CariProfilMachine(); });
 $("#ItemIDReport").keydown(function(e){ var isi = $(e.target).val(); CariProfilMachine(); });
 
 $("#empty").click(function(){
 $("#ItemIDReport").val(""); 
 $("#PartNoReport").val(""); 
 $("#PartNameReport").val("");
 $("#CustNameReport").val(""); });
 
 function CariProfilMachine(){
 var kode = $("#ItemIDReport").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#PartNoReport").val(data.PartNo);
 $("#PartNameReport").val(data.PartName);
 $("#IDCustReport").val(data.IDCust);
 $("#CustNameReport").val(data.CustName2)
  }  });  };



$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList(); });

            
function MasterList(){
 var kode = $("#IDCust").val();
 $("#MasterList").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ReportDies/MasterList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };
 
$("#SubmitSearch").click(function(){
var ReportType = $("#ReportType").val();
var $this = $(this); 

if(ReportType==1){
 var ItemIDReport = $("#ItemIDReport").val();
 var PartNoReport = $("#PartNoReport").val();
 var ProsesD = $("#ProsesD").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var IDCust = $("#IDCust").val();
 var string = "&ItemIDReport="+ItemIDReport+"&ProsesD="+ProsesD+"&tgl1="+tgl1+"&tgl2="+tgl2+"&IDCust="+IDCust;
 if(tgl1.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); }

if(tgl2.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); } 

if(PartNoReport.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Part No tidak boleh kosong'); return true (); }

if(ProsesD.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Dies No. tidak boleh kosong'); return true (); }

$this.button('loading');
$("#detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/ReportDies/ReadReport1",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
$this.button('reset');
$("#detail_report").html(data); },1000) }	 });
}else{
 var ItemIDReport = $("#ItemIDReport").val();
 var PartNoReport = $("#PartNoReport").val();
 var ProsesD = $("#ProsesD").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var IDCust = $("#IDCust").val();    
 var string = "&ItemIDReport="+ItemIDReport+"&ProsesD="+ProsesD+"&tgl1="+tgl1+"&tgl2="+tgl2+"&IDCust="+IDCust ;
               
if(tgl1.length == 0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); }

if(tgl2.length == 0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); } 
         
$this.button('loading');
$("#detail_report").html('');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/ReportDies/ReadReport2",
data	: string,
cache	: false,
success	: function(data){
setTimeout(function(){
$this.button('reset');
$("#detail_report").html(data); },1000) } }); } return false();	 });
    
$("#Export").click(function(){
 var ReportType = $("#ReportType").val();
 if(ReportType==1){
 var ItemIDReport = $("#ItemIDReport").val();
 var PartNoReport = $("#PartNoReport").val();
 var ProsesD = $("#ProsesD").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var IDCust = $("#IDCust").val();
 var string = tgl1+"/"+tgl2+"/"+ItemIDReport+"/"+ProsesD;
 
 if(tgl1.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); }

if(tgl2.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); } 

if(PartNoReport.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Part No tidak boleh kosong'); return true (); }

if(ProsesD.length==0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Dies No. tidak boleh kosong'); return true (); }

    var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
	waitingDialog3.hide();
    window.open('<?php echo site_url();?>/ReportDies/ExportReport1/'+string);
	},1000)       
	}else{ 
 var ItemIDReport = $("#ItemIDReport").val();
 var PartNoReport = $("#PartNoReport").val();
 var ProsesD = $("#ProsesD").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var IDCust = $("#IDCust").val();
 var string2 = tgl1+"/"+tgl2+"/"+IDCust+"/"+ProsesD+"/"+ItemIDReport;
if(tgl1.length == 0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); }

if(tgl2.length == 0){
$("#myModal_Fail").modal('show');
$("#pesan_Fail").text('Tanggal tidak boleh kosong'); return false(); } 
    var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
	waitingDialog3.hide();
    window.open('<?php echo site_url();?>/ReportDies/ExportReport2/'+string2);
	},1000)  } return false(); });    

             
$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#ItemIDReport").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); });
$("#PartNoReport").click(function(){ $("#myModal_MaterialList").modal('show'); MasterList(); }); 
   
    
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="tgl1" name="tgl1">
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="tgl2" name="tgl2">
</div>              
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label blink" style="color: blue;">Report</label>
<div class="col-xs-8">
<select name="ReportType" id="ReportType" class="form-control">      
<option value="2">Summary</option>
<option value="1">Detail</option>
</select></div></div>

<div class="form-group">
 <label class="col-xs-4 control-label">Customer</label>
 <div class="col-xs-8">
 <select name="IDCust" id="IDCust" class="form-control">
 <option value="ALL">All Customer</option>
 <?php foreach($l_cust->result() as $t){ if($IDCust==$t->Code){ ?>
 <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Code;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
 <?php } } ?> 
 </select>
 </div></div>
 </div>

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-3">
<input type="text" id="ItemIDReport" name="ItemIDReport"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="PartNoReport" name="PartNoReport"  class="form-control" readonly="true" >
</div><button type="button" name="empty" id="empty" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>


 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartNameReport" name="PartNameReport"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<input type="text" id="CustNameReport" name="CustNameReport"  class="form-control" readonly="readonly">
</div>
</div>


<div class="form-group">
<label class="col-xs-4 control-label">Dies No</label>
<div class="col-xs-8">
<select name="ProsesD" id="ProsesD" class="form-control">      
    <option >1</option>
    <option >2</option>
    <option >3</option>
    <option >4</option>
    <option >5</option>
    <option >6</option>
    <option >7</option>
    <option value="ALL">All Process</option>
    </select></div> 
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
</div></div></div></div></div>
</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="detail_report"></div>
</div></div></div>

</div></div></div>

<div class="modal fade" id="myModal_MaterialList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>


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
                        
<div id="pesan_Fail"></div>
</div></div></div></div></div><!-- /.modal -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $("#PartnerID").select2(); $("#PartnerID2").select2(); $("#IDCust").select2();

    //Date picker
    $('#tgl1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
  });
</script> 

<script type="text/javascript"> 
function pilihDies(id){
	$("#myModal_MaterialList").modal('hide');
	$("#ItemIDReport").val(id);
	$("#ItemIDReport").focus(); }
</script>

<script> $(function () { $("#t_list_master").DataTable(); });</script>