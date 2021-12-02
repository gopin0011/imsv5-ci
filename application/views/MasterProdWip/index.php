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
url		: "<?php echo site_url(); ?>/MasterProdWip/ListProduct",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

function ConectingBomList(){
var id = $("#ItemID").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterProdWip/ConectingBomList",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#ConectingBomList").html(data);
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

$("#Min").focus(function(){ var  Min = $("#Min").val();
 if(Min == 0){ $("#Min").val(""); return false(); }  });
        
$("#Min").focusout(function(){ var  Min = $("#Min").val();
 if(Min.length==0){ $("#Min").val("0");   return false(); }  });

$("#Max").focus(function(){ var  Max = $("#Max").val();
 if(Max == 0){ $("#Max").val(""); return false(); }  });
        
$("#Max").focusout(function(){ var  Max = $("#Max").val();
 if(Max.length==0){ $("#Max").val("0");   return false(); }  });

$("#PcsPerDay").focus(function(){ var  PcsPerDay = $("#PcsPerDay").val();
 if(PcsPerDay == 0){ $("#PcsPerDay").val(""); return false(); }  });
        
$("#PcsPerDay").focusout(function(){ var  PcsPerDay = $("#PcsPerDay").val();
 if(PcsPerDay.length==0){ $("#PcsPerDay").val("0");   return false(); }  });  

$("#StockWip").focus(function(){ var  StockWip = $("#StockWip").val();
 if(StockWip == 0){ $("#StockWip").val(""); return false(); }  });
        
$("#StockWip").focusout(function(){ var  StockWip = $("#StockWip").val();
 if(StockWip.length==0){ $("#StockWip").val("0");   return false(); }  });

$("#StockFG").focus(function(){ var  StockFG = $("#StockFG").val();
 if(StockFG == 0){ $("#StockFG").val(""); return false(); }  });
        
$("#StockFG").focusout(function(){ var  StockFG = $("#StockFG").val();
 if(StockFG.length==0){ $("#StockFG").val("0");   return false(); }  });
 
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
 url	: "<?php echo site_url(); ?>/MasterProdWip/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){ 
 $("#Home2").click(); },1000) 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#PartNo").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); ConectingBomList(); });
	
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
 $("#PcsPerDay").val(data.PcsPerday);
 $("#Min").val(data.Min);
 $("#Max").val(data.Max);
 $("#StockFG").val(data.StockFG);
 $("#StockWip").val(data.StockWip);
 $("#IsActive").val(data.IsActive);
 ConectingBomList();
			 }  });  };
             

             
$("#Hapus").click(function(){
 var ItemID	    = $("#ItemID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWip/Hapus_Product",
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
 url		: "<?php echo site_url(); ?>/MasterProdWip/ListProduct1",
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
 
 $("#AddActivity").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
 
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<?php  $cek = $this->Role_Model->MProdWipUp(); if(!empty($cek)){ ?>
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
<?php  $cek = $this->Role_Model->MProdWipView(); if(!empty($cek)){ ?>
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

<input type="text" id="ItemID" name="ItemID" hidden="" readonly="true">

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
    


</div>
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Need/Day</label>
<div class="col-xs-8">
<input type="text" id="PcsPerDay" name="PcsPerDay"  class="form-control" placeholder="Kebutuhan Per Hari">
</div>
</div> 


 <div class="form-group">
 <label class="col-xs-4 control-label">Status</label>
 <div class="col-xs-8">
 <select name="IsActive" id="IsActive" class="form-control">
 <?php  foreach($l_MDetailStatus->result() as $t){ if($IDBlokir==$t->Detail){ ?>
 <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Detail;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
 <?php } } ?>  </select> </div> </div> 
        
 </div>
 </div></form>

 <div class="panel-footer" data-toggle="btn-toggle">
 <div class="btn-group">
 <button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa  fa-save"></i>&nbsp; Save</button>
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 <?php  $cek = $this->Role_Model->MProdWipDel(); if(!empty($cek)){ ?>
 <button type="button" name="Hapus_User" id="Hapus_User" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</button>        
 <?php } ?>
 </div></div>
</div></div></div>

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#MainMenu" > <span style="float: right;"><i class="fa fa-bars"></i></span></a> </h4> 
<div class="btn-group">
<button type="button" class="btn btn-success" id="AddActivity">
<i class="fa fa-plus"></i>&nbsp; Add</button>
</div>
</div>
<div id="MainMenu" class="collapse in">
<div class="panel-body">

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="ConectingBomList"></div>
</div></div></div>
</div></div></div></div>

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

 function SelectBOM(SysID,PartTypeID){
$("#AddActivity").button('loading');
$("#myModal_product").modal('hide');
var ItemID = $("#ItemID").val() ;
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterProdWip/SelectBOM",
 data	: "&SysID="+SysID+"&ItemID="+ItemID+"&PartTypeID="+PartTypeID,
 cache	: false,
 success	: function(data){
 ConectingBomList2();
 setTimeout(function() {  $("#AddActivity").button('reset'); }, 500) ;
 	} }); return false(); };

function ActionDelete(SysID){
$("#Del_"+SysID).button('loading');
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterProdWip/DeleteConecting",
 data	: "&SysID="+SysID,
 cache	: false,
 success	: function(data){
 setTimeout(function() {  ConectingBomList2();  }, 500) ;
 	} }); return false(); };
    
function ConectingBomList2(){
var id = $("#ItemID").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterProdWip/ConectingBomList",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#ConectingBomList").html(data);
} }); };
    
</script>


<script>
  $(function () {
    //Initialize Select2 Elements SupplierIDHead
    $("#CustIDView").select2(); 
    
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

  });
</script> 


<script> $(function () { $("#t_list_master").DataTable(); });</script>