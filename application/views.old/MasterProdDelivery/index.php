<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
 $(document).ready(function(){
 ion.sound({
 sounds: [
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
    
tampil_data();
function tampil_data(){
var id = $("#CustIDView").val() ;
 $('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterProdDelivery/ListProduct",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

$("#form-tab").click(function(){
    document.getElementById("form").reset();
    });	
    
$("#CustIDView").change(function(){
setTimeout(function() { $('#reload').click(); }, 200); });
 
$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });

    
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
          
    
$("#PartNo").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PartName").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#Spec1").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#Spec2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });   
$("#StockFG").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#StockWip").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#NeedPerDay").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#Min").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#Max").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#Price").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#PcsPerDay").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#PcsPerSheet").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
$("#PcsPerKg").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });     
    
	
$("#Save").click(function(){
 var PartNo	    = $("#PartNo").val();
 var PartName	= $("#PartName").val();
 var IDCust	    = $("#IDCust").val();
 var string = $("#form").serialize();
 if(PartNo.length==0){ NotifFail('Part No Harus di isi');  return false(); } 
 if(PartName.length==0){ NotifFail('Part Name Harus di isi');  return false(); } 
 if(IDCust.length==0){ NotifFail('Customer Harus di isi'); return false(); }
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterProdDelivery/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){ 
 $("#Home2").click(); },1000) 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#ItemID").load(CariProfilProduct());
$("#ItemID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
$("#ItemID").keyup(function(){ CariProfilProduct();		});
	
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
                $("#CustName").val(data.CustName);
                $("#IDProject").val(data.IDProject);
                $("#Spec1").val(data.Spec1);
                $("#Spec2").val(data.Spec2);
                $("#PcsPerDay").val(data.PcsPerday);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#PcsPerKg").val(data.PcsPerKg);
                $("#Price").val(data.Price);
                $("#Min").val(data.Min);
                $("#Max").val(data.Max);
                $("#StockFG").val(data.StockFG);
                $("#StockWip").val(data.StockWip);
                $("#MaterialType").val(data.MaterialType);
                $("#RegID").val(data.MaterialNum);
                $("#IsActive").val(data.IsActive);
               
			 }  });  };
             

             
$("#Hapus").click(function(){
 var ItemID	    = $("#ItemID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdDelivery/Hapus_Product",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Home2").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
    
 $("#Hapus_User").click(function(){
 var ItemID	    = $("#ItemID").val();
 var PartNo	    = $("#PartNo").val();
 if(ItemID.length==0){
 }else{
 $("#myModalDelete").modal('show');
 $("#pesan3").text("Anda yakin menghapus bro ?");
 $("#PartNoDelete").text(PartNo); }
 });

$('#ReloadCP1').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList(); });
      
function MasterList(){
 var kode = "" ;
 $("#MasterList").html("");
 $('#ReloadCP1').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdDelivery/ListProduct1",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP1').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };
 
 $("#RegID").focus(function(e){
 var isi = $(e.target).val();
 CariRegID(); });
 $("#RegID").keyup(function(){ CariRegID();	 });
function CariRegID(){
 var kode = $("#RegID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#PartNoMaterial").val(data.PartNo);
 $("#PartNameMaterial").val(data.PartName); }  });  };
 
$("#RegID").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#PartNoMaterial").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#PartNameMaterial").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
 
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

<div class="col-xs-3 pull-right">
<div class="input-group">
<span class="input-group-btn">
<button disabled="" type="button" class="btn" style="color: transparent; background: transparent;">@</button>
</span>
<select name="CustIDView" id="CustIDView" class="form-control col-xs-12" style="width: 100%;">
<?php if(empty($PartnerID)){ ?>
<option value="">Select</option>
<?php } foreach($l_MCust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option> <?php } } ?> 
</select>
</div></div>
</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="tampil_data"></div>

</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal" id="form">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse in">

<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">ID</label>
<div class="col-xs-8">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<input type="text" id="PartNo" name="PartNo"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control">
</div></div> 

<div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-4">
<select id="IDCust" name="IDCust" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="">-</option>
<?php } foreach($l_MCust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } } ?>  
</select>
</div>

<div class="col-xs-4">
<select id="IDProject" name="IDProject" class="form-control" style="width: 100%;">
<?php if(empty($IDProject)){ ?>
<option value="">-</option>
<?php } foreach($l_MProject->result() as $t){ if($IDProject==$t->ProjectName){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->ProjectName;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->ProjectName;?></option>
<?php } } ?>  
</select>
</div>

</div>

  <div class="form-group">
<label class="col-xs-4 control-label">Need/Day</label>
<div class="col-xs-8">
<input type="text" id="PcsPerDay" name="PcsPerDay"  class="form-control" placeholder="Kebutuhan Per Hari">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Stock Min-Max</label>
<div class="col-xs-4">
<input type="text" id="Min" name="Min"  class="form-control" placeholder="Min">
</div>
<div class="col-xs-4">
<input type="text" id="Max" name="Max"  class="form-control" placeholder="Max">
</div>
</div> 
</div>
<div class="col-md-6">
 
 
  <div class="form-group">
<label class="col-xs-4 control-label">Std Packing</label>
<div class="col-xs-8">
<input type="text" id="StdPack" name="StdPack" class="form-control" placeholder="Standart Packing">
</div>
</div> 

  <div class="form-group">
<label class="col-xs-4 control-label">Price</label>
<div class="col-xs-8">
<input type="text" id="Price" name="Price" class="form-control" placeholder="Harga Part">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="StockWip" name="StockWip"  class="form-control" placeholder="Stock WIP">
</div> 
<div class="col-xs-4">
<input type="text" id="StockFG" name="StockFG"  class="form-control" placeholder="Stock Finish Good">
</div>
</div>

  <div class="form-group">
        <label class="col-xs-4 control-label">Status</label>
        
                <div class="col-xs-8">
            <select name="IsActive" id="IsActive" class="form-control">

    <?php 
	foreach($l_MDetailStatus->result() as $t){ if($IDBlokir==$t->Detail){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
        </div>  
        
 <div class="form-group">
<label class="col-xs-4 control-label">Material Use</label>
<div class="col-xs-4">
<input type="text" id="RegID" name="RegID"  class="form-control" placeholder="ID">
</div>
<div class="col-xs-4">
<input type="text" id="PartNoMaterial" name="PartNoMaterial"  class="form-control" placeholder="Part No" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartNameMaterial" name="PartNameMaterial"  class="form-control" placeholder="Part Name" readonly="true">
</div></div> 

</div>
</div></form>

 <div class="panel-footer" data-toggle="btn-toggle">
 <div class="btn-group">
 <button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa  fa-save"></i>&nbsp; Save</button>
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 <button type="button" name="Hapus_User" id="Hapus_User" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</button>        
 </div></div>
</div></div></div>
</div></div></div>
</div>
</div></div>


 <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
 <h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
 <div id="pesan3"></div>
 <div style="font-size: larger; font-weight: bold;" id="PartNoDelete"></div>
 <br /><br /><br />
 <div class="panel-footer">
 <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Batal</button>
 <button type="button" name="Hapus" id="Hapus" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ok</button>
 <form class="navbar-right" role="search">
 <div class="form-group">
 <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
 </form>
 </div>
 </div></div></div></div></div><!-- /.modal -->
 
 
  <div class="modal fade" id="myModal_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP1" name="ReloadCP1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>
 
<script type="text/javascript"> 
function pilih(id){
 $("#myModal_product").modal('hide');
 $("#RegID").val(id);
 $("#RegID").focus(); }
</script>


<script>
  $(function () {
    //Initialize Select2 Elements SupplierIDHead
    $("#CustIDView").select2(); $("#IDCust").select2();$("#IDProject").select2();$("#SupplierIDHead").select2();
    $("#PartTypeID").select2(); $("#SupplierID").select2();
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