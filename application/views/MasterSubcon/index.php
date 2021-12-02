<!-- start index.view -->

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

$("#form-tab").click(function(){
    document.getElementById("form").reset();
    });	
        
tampil_data();
function tampil_data(){
//var id = $("#CategoryIDView").val() ;
 $('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterSubcon/ListProduct",
data	: "&id=",
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

 
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
$("#PartName").keyup(function(e)
{ 
    var isi = $(e.target).val(); 
    if(e.which == 222) isi = isi.replace(/'/g, '"');
    $(e.target).val(isi.toUpperCase()); 
});
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
 var duplikasi = $('#duplikasi').val();   
 var PartName = $("#PartName").val();
 var PartNo = $("#PartNo").val();
 //var Spec = $("#Spec").val();
 var IDUnit	 = $("#IDUnit").val();
 var string = $("#form").serialize();
 
 setTimeout(function(){
    if(duplikasi == '1'){ return false(); }
    if(PartName.length==0){ NotifFail('Product Name Harus di isi');   return false(); } 
    //if(Spec.length==0){ NotifFail('Spec harus diisi');  return false(); } 
    //if(IDCategory.length==0){ NotifFail('Kategori harus di isi'); return false(); }
    if(PartNo.length==0){ NotifFail('Product No Harus di isi');   return false(); }
    if(IDUnit.length==0){ NotifFail('Unit Harus diisi'); return false(); }
    $.ajax({
    type	: 'POST',
    url	: "<?php echo site_url(); ?>/MasterSubcon/Save",
    data	: string,
    cache	: false,
    success	: function(data){
    NotifSuccsess(data);
    setTimeout(function(){ 
    //$("#Home2").click(); 
    },1000) 	},
    error : function(xhr, teksStatus, kesalahan) {
    NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false();
 },500);
});

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
 $("#PartName").val(data.PartName);
 $("#PartNo").val(data.PartNo);
 $("#Spec").val(data.Spec2);
 $("#Price").val(data.Price);
 $("#Min").val(data.Min);
 $("#Max").val(data.Max);
 $("#StockFG").val(data.StockFG);
 $("#IDCategory").val(data.IDCategory);
 $("#IDUnit").val(data.IDUnit);
 $("#IsActive").val(data.IsActive);
 }  });  };

/*             
$('#PartName').blur(function(){
    $.ajax({
         type	: 'POST',
         url		: "<?php echo site_url(); ?>/MasterSubcon/GetInfoProduct",
         data	: "PartName="+$(this).val(),
         cache	: false,
         dataType : "json",
         success	: function(data)
         {
            if(data['status'] == '1') {
                hasil = false;
                NotifFail(data['msg']);
                $('#duplikasi').val('1');
                $('#PartName').focus();
            }
            else
            {
                $('#duplikasi').val('0');
            }
         }
    });
});

$('#PartNo').blur(function(){
    $.ajax({
         type	: 'POST',
         url		: "<?php echo site_url(); ?>/MasterSubcon/GetInfoProduct",
         data	: "PartNo="+$(this).val(),
         cache	: false,
         dataType : "json",
         success	: function(data)
         {
            if(data['status'] == '1') {
                hasil = false;
                NotifFail(data['msg']);
                $('#duplikasi').val('1');
                $('#PartNo').focus();
            } 
            else
            {
                $('#duplikasi').val('0');
            }
         }
    });
});
*/

$("#Hapus").click(function(){
 var ItemID	    = $("#ItemID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterSubcon/Hapus_Product",
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
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<?php  $cek = $this->Role_Model->MSJ(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>


</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<?php  $cek = $this->Role_Model->MSJ(); if(!empty($cek)){ ?>
<div id="tampil_data"></div>
<?php } ?>
</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal" id="form">
<input type="hidden" name="duplikasi" id="duplikasi" value="0">
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
</div> 
</div>    

    <div class="form-group">
<label class="col-xs-4 control-label">Product Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control">
</div> 
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<input type="text" id="PartNo" name="PartNo"  class="form-control">
</div> 
</div>

</div>  


<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<input type="text" id="Spec" name="Spec"  class="form-control">
</div> 
</div>

      <div class="form-group">
        <label class="col-xs-4 control-label">Unit</label>
        <div class="col-xs-8">
            <select name="IDUnit" id="IDUnit" class="form-control">
            <?php if(empty($unit_name)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_unit_name->result() as $t){ if($unit_name==$t->unit){ ?>
     <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->unit;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->unit;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>

 <div class="form-group">
        <label class="col-xs-4 control-label">Status</label>
        <div class="col-xs-8">
            <select name="IsActive" id="IsActive" class="form-control">
            <option value="1" selected>Active</option>
            <option value="0">Non Active</option>
    </select>
        </div>
        </div> 

</div>  
</div></form>

 <div class="panel-footer" data-toggle="btn-toggle">
 <div class="btn-group">
 <button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa  fa-save"></i>&nbsp; Save</button>
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 <?php  $cek = $this->Role_Model->MSJ(); if(!empty($cek)){ ?>
 <button type="button" name="Hapus_User" id="Hapus_User" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</button>        
 <?php  } ?>
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

<!-- end index.view -->