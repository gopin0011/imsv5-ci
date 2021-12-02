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
 document.getElementById("form").reset(); });
 	
$("#Add").click(function(){
 document.getElementById("form").reset(); });
    
$("#form-tab").click(function(){
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click(); },300) ;
 ta}, 500); });
 
$('#Add').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 AmbilForm(); 
 }, 300); 
 setTimeout(function() {
 $this.button('reset');
 AmbilForm(); 
 $("#ItemID").focus();
 $("#ItemID").click();
 }, 500);
 });

$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
     
tampil_data();
function tampil_data(){
var DeptIDView = $("#DeptIDView").val() ;
var LocationIDView = $("#LocationIDView").val() ;
 $('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterAsset/ListProduct",
data	: "&LocationIDView="+LocationIDView+"&DeptIDView="+DeptIDView,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

function tampil_data2(){
 var kode = "" ;
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterAsset/ListProduct2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#tampil_data2").html(data); }
 }); } ;

function AmbilForm(){
 var kode = "";
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoTambahAsset",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#ItemID").val(data.ItemID);
 }  });  };
 
function CopyForm(){
 var ItemNo		     = $("#ItemNo").val();
 var Remark		     = $("#Remark").val();
 var IsActive		     = $("#IsActive").val();
 var ItemName		     = $("#ItemName").val();
 var Spec		     = $("#Spec").val();
 var CategoryID	 = $("#CategoryID").val();
 var UnitID	 = $("#UnitID").val();
 var LocationID	 = $("#LocationID").val();
 var ItemID	 = $("#ItemID").val();
 var string = $("#form").serialize();
 if(ItemName.length==0){ NotifFail('<em><strong>Name Asset</strong></em> Harus di isi');  return false(); } 
 if(Spec.length==0){ NotifFail('<em><strong>Spec</strong></em> harus diisi'); return false(); }
 if(LocationID.length==0){ NotifFail('<em><strong>Lolcation</strong></em> Harus diisi'); return false(); }
 if(CategoryID.length==0){ NotifFail('<em><strong>Category</strong></em> Harus diisi'); return false(); } 
 if(UnitID.length==0){ NotifFail('<em><strong>Unit</strong></em> Harus diisi');  return false(); }  
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoCopyAsset",
 data	: "ItemNo="+ItemNo+"&ItemName="+ItemName+"&ItemID="+ItemID+"&UnitID="+UnitID+"&CategoryID="+CategoryID+"&LocationID="+LocationID+"&Remark="+Remark+"&Spec="+Spec+"&IsActive="+IsActive,
 dataType : "json",
 success	: function(data){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 $("#ItemID").val(data.ItemID);
 setTimeout(function(){
 waitingDialog3.hide(); },2000) }  });  };
         
function Avatar(){
 var kode = $("#ItemID").val();
 $.ajax({
 type	: 'POST',
 url    : "<?php echo site_url(); ?>/MasterAsset/Avatar",
 data	: "&kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Avatar").html(data); } }); }
    	
function Avatar3(){
 var kode = $("#ItemID3").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterAsset/Avatar",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Avatar3").html(data); } }); }

$("#DeptIDView").change(function(){
setTimeout(function() { $('#reload').click(); }, 200); });

$("#LocationIDView").change(function(){
setTimeout(function() { $('#reload').click(); }, 200); });
    
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
  
    	
$("#Save").click(function(){
 var ItemName = $("#ItemName").val();
 var CategoryID = $("#CategoryID").val();
 var UnitID = $("#UnitID").val();
 var LocationID = $("#LocationID").val();
 var CategoryID = $("#CategoryID").val();
 var string = $("#form").serialize();
 if(ItemName.length==0){ NotifFail('Name Asset Harus Di isi');   return false(); } 
 if(LocationID.length==0){ NotifFail('Lolcation Harus Di isi');  return false(); } 
 if(CategoryID.length==0){ NotifFail('Category Harus Di isi');  return false(); } 
 if(UnitID.length==0){ NotifFail('Unit Harus Di isi');  return false(); } 
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterAsset/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){ 
 $("#Home2").click(); },1000) 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#ItemID").load(CariProfilProduct());
$("#ItemID").focus(function(e){ 
 var isi = $(e.target).val(); CariProfilProduct(); Avatar(); tampil_data2(); });
$("#ItemID").keyup(function(){ CariProfilProduct(); Avatar(); tampil_data2(); });
$("#ItemID").click(function(){ Avatar(); CariProfilProduct(); tampil_data2() 

setTimeout(function(){
 var id = $("#Hardware").val();
 if(id==0){$("#DetailComputer").hide();}
 if(id==0){$("#DetailPrinter").hide();}
 if(id==73){$("#DetailComputer").hide();}
 if(id==73){$("#DetailPrinter").hide();}
 if(id==74){$("#DetailComputer").hide();}
 if(id==74){$("#DetailPrinter").hide();}
 if(id==71){$("#DetailComputer").show();}
 if(id==72){$("#DetailComputer").show();}
 if(id==71){$("#DetailPrinter").hide();}
 if(id==72){$("#DetailPrinter").hide();}
 if(id==70){$("#DetailPrinter").show();}
 if(id==70){$("#DetailComputer").hide();}
 },500) 
 });   	
function CariProfilProduct(){
 var kode = $("#ItemID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoAsset",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#ItemNo").val(data.ItemNo);
 $("#ItemName").val(data.ItemName);
 $("#Spec").val(data.Spec);
 $("#LocationID").val(data.LocationID);
 $("#PurchaseDate").val(data.PurchaseDate);
 $("#CategoryID").val(data.CategoryID);
 $("#UnitID").val(data.UnitID);
 $("#IsActive").val(data.IsActive);
 $("#Remark").val(data.Remark);
 $("#Qty").val(data.Qty);
 $("#Price").val(data.Price);
 $("#Amount").val(data.Amount);
 $("#IDDept").val(data.Department);
 $("#PartnerID").val(data.PartnerID);
 $("#OS").val(data.OS);
 $("#Office").val(data.Office);
 $("#Autocad").val(data.Autocad);
 $("#NX").val(data.NX);
 $("#SW").val(data.SW);
 $("#Catia").val(data.Catia);
 $("#FB").val(data.FB);
 $("#DB").val(data.DB);
 $("#Hardware").val(data.Hardware);
 $("#RAM").val(data.RAM);
 $("#HDD").val(data.HDD);
 $("#VGACard").val(data.VGACard);
 $("#NetCard").val(data.NetCard);
 $("#Processor").val(data.Processor);
 $("#RemarkDetail").val(data.RemarkDetail);
 $("#PrinterType").val(data.PrinterType);
 $("#ColorType").val(data.ColorType);
 $("#SizePaper").val(data.SizePaper);
 waitingDialog3.hide();
 AmountKey(); PriceKey(); QtyKey(); CariProfilPartner();
 Avatar();  
 }  });  };
 
$("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){
 $("#SearchItem").click(); } });
 
$("#Hardware").change(function(){
 var id = $("#Hardware").val();
 if(id==0){$("#DetailComputer").hide();}
 if(id==0){$("#DetailPrinter").hide();}
 if(id==73){$("#DetailComputer").hide();}
 if(id==73){$("#DetailPrinter").hide();}
 if(id==74){$("#DetailComputer").hide();}
 if(id==74){$("#DetailPrinter").hide();}
 if(id==71){$("#DetailComputer").show();}
 if(id==72){$("#DetailComputer").show();}
 if(id==71){$("#DetailPrinter").hide();}
 if(id==72){$("#DetailPrinter").hide();}
 if(id==70){$("#DetailPrinter").show();}
 if(id==70){$("#DetailComputer").hide();}
 });

$("#ItemID3").click(function(){
 var id = $("#ItemID3").val();
 $("#ItemID3").val(id); Avatar3(); CariProfilProduct2();
 setTimeout(function(){
 var id = $("#Hardware3").val();
 if(id==0){$("#DetailComputer3").hide();}
 if(id==0){$("#DetailPrinter3").hide();}
 if(id==73){$("#DetailComputer3").hide();}
 if(id==73){$("#DetailPrinter3").hide();}
 if(id==74){$("#DetailComputer3").hide();}
 if(id==74){$("#DetailPrinter3").hide();}
 if(id==71){$("#DetailComputer3").show();}
 if(id==72){$("#DetailComputer3").show();}
 if(id==71){$("#DetailPrinter3").hide();}
 if(id==72){$("#DetailPrinter3").hide();}
 if(id==70){$("#DetailPrinter3").show();}
 if(id==70){$("#DetailComputer3").hide();}
 },500) });
 
function CariProfilProduct2(){
 var kode = $("#ItemID3").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoAsset",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#ItemNo3").val(data.ItemNo);
 $("#ItemName3").val(data.ItemName);
 $("#Spec3").val(data.Spec);
 $("#PurchaseDate3").val(data.PurchaseDate);
 $("#LocationID3").val(data.LocationID);
 $("#CategoryID3").val(data.CategoryID);
 $("#UnitID3").val(data.UnitID);
 $("#IsActive3").val(data.IsActive);
 $("#Remark3").val(data.Remark);
 $("#Department").val(data.Department);
 $("#CreatedBy").val(data.CreatedBy);
 $("#Qty3").val(data.Qty);
 $("#Price3").val(data.Price);
 $("#Amount3").val(data.Amount);
 $("#partner_name3").val(data.partner_name);
 $("#OS3").val(data.OS);
 $("#Office3").val(data.Office);
 $("#Autocad3").val(data.Autocad);
 $("#NX3").val(data.NX);
 $("#SW3").val(data.SW);
 $("#Catia3").val(data.Catia);
 $("#FB3").val(data.FB);
 $("#DB3").val(data.DB);
 $("#Hardware3").val(data.Hardware);
 $("#RAM3").val(data.RAM);
 $("#HDD3").val(data.HDD);
 $("#VGACard3").val(data.VGACard);
 $("#NetCard3").val(data.NetCard);
 $("#Processor3").val(data.Processor);
 $("#RemarkDetail3").val(data.RemarkDetail);
 $("#PrinterType3").val(data.PrinterType);
 $("#ColorType3").val(data.ColorType);
 $("#SizePaper3").val(data.SizePaper);
 AmountKey(); PriceKey(); QtyKey();
 Avatar();   }  });  };
 
$("#PartnerID").focus(function(e){
 var isi = $(e.target).val();
 CariProfilPartner(); });
$("#PartnerID").keyup(function(){
 CariProfilPartner(); });

function CariProfilPartner(){
 var kode = $("#PartnerID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoPartner",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#partner_code").val(data.partner_code);
 $("#partner_name").val(data.partner_name);
 }  });  };

function hitung(){
 var Qty      = $("#Qty").val();
 var HasilQty = Qty.replace(/\,/g,'');
 var Price      = $("#Price").val();
 var HasilPrice = Price.replace(/\,/g,'');
 var Amount = parseFloat(HasilQty) *  parseFloat(HasilPrice);
 $("#Amount").val(Amount); }
        
$("#Price").keyup(function(){
hitung(); AmountKey(); });
$("#Qty").keyup(function(){
hitung(); AmountKey();});
             
$("#Qty").focus(function(){
 var  Qty = $("#Qty").val();
 if(Qty == 0){
 $("#Qty").val(""); return false(); }  });

$("#Qty").focusout(function(){ var  Qty = $("#Qty").val();
if(Qty.length==0){ $("#Qty").val("0"); return false(); }  });
$("#Price").focus(function(){
 var  Price = $("#Price").val();
 if(Price == 0){
 $("#Price").val(""); return false(); }  });
$("#Price").focusout(function(){ var  Price = $("#Price").val();
 if(Price.length==0){ ("#Price").val("0"); return false(); }  });
        
$("#Qty").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; } });
         
$("#Price").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
$("#Qty").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});

function AmountKey(){
$("#Amount").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
$("#Amount3").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
};
function PriceKey(){
$("#Price").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
$("#Price3").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
};
function QtyKey(){
$("#Qty").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
$("#Qty3").priceFormat({
  prefix: '',
  centsSeparator: '.',
  thousandsSeparator: ',',
  centsLimit: 0
});
};
     
$.fn.capitalize = function () {
 $.each(this, function () {
 var split = this.value.split(' ');
 for (var i = 0, len = split.length; i < len; i++) {
 split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);  }
 this.value = split.join(' '); });
 return this; };
    
$("#ItemName").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
 
$("#Remark").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
     
$("#Hapus").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterAsset/Hapus_Product",
 data	: "&DocNumDetailDelete="+DocNumDetailDelete,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Home2").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
 
$("#Hapus2").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete2").val();
 $("#myModalDelete2").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterAsset/Hapus_Product",
 data	: "&DocNumDetailDelete="+DocNumDetailDelete,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Add").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
    
function MasterListPartner(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterAsset/MasterListPartner",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterListPartner").html(data);	} }); };
 
$("#PartnerID").click(function(){
$("#myModal_Partner").modal('show'); MasterListPartner(); });

$("#PrintList").click(function(){
 var LocationIDView = $("#LocationIDView").val() ;
 var DeptIDView = $("#DeptIDView").val() ;
 var string = LocationIDView+"/"+DeptIDView;
 window.open('<?php echo site_url();?>/MasterAsset/PrintList/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
 return false(); });
 
 
$("#Download").click(function(){
 var LocationIDView = $("#LocationIDView").val() ;
 var DeptIDView = $("#DeptIDView").val() ;
 var string = LocationIDView+"/"+DeptIDView;
 
$("#Download").button('loading');
setTimeout(function(){
$("#Download").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/MasterAsset/ExportProduct/'+string);
  });
  
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">    
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->Role_Model->MAssetUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>
<button type="button" class="btn btn-info" id="Download" name="Download" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<button type="button" class="btn btn-warning" id="PrintList" name="PrintList" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
</div></div>
<br /><hr />

<div class="form-group">

<div class="col-md-2 col-sm-2 col-xs-12 pull-right top_search">
<div class="input-group">
<input type="text" class="form-control" id="DocNumSearch" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
<a  onclick="Search()" href="#" >
<button class="btn btn-default" id="SearchItem"  type="button" >Go!</button></a>
</span>
</div></div>

 <div class="col-md-3 col-sm-3 col-xs-12 pull-right top_search">
 <div class="input-group">
 <select name="DeptIDView" id="DeptIDView" class="form-control col-md-2 col-xs-12">
 <?php if(empty($DeptIDView)){ ?>
 <option value="">All Dept</option> <?php }
 foreach($DeptList->result() as $t){ if($DeptList==$t->Dept_Name){ ?>
 <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->Dept_Name;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option>
 <?php } } ?> 
 </select>
 <span class="input-group-btn">
 <a  onclick="Search()" href="#" >
 <button class="btn btn-default" id="SearchItem"  type="button" style="color: transparent;">.</button></a>
 </span>
 </div></div>
 <div class="col-md-3 col-sm-3 col-xs-12 pull-right top_search">
 <div class="input-group">
 <select name="LocationIDView" id="LocationIDView" class="form-control col-md-2 col-xs-12">
 <?php if(empty($LocationID)){ ?>
 <option value="All">All Location</option>
 <?php } foreach($Location->result() as $t){ if($Location==$t->Location){ ?>
 <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Location;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->SysID;?>"><?php echo $t->Location;?></option>
 <?php } } ?>  </select>
 <span class="input-group-btn">
 <a  onclick="Search()" href="#" >
 <button class="btn btn-default" id="SearchItem"  type="button" style="color: transparent;">.</button></a>
 </span>
 </div></div>
 </div>
 
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<?php  $cek = $this->Role_Model->MAssetView(); if(!empty($cek)){ ?>
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
</span> Data Customer &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse in">

<div class="panel-body">
<div class="col-md-6">

<div class="box-body">
<div class="box box-success">
<div class="box-body">
<div onclick="AvatarUpload()" id="Avatar" ></div>
</div></div></div>
<hr />
<div class="form-group">
<label class="col-xs-4 control-label">ID</label>
<div class="col-xs-8">
<input type="text" id="ItemID" name="ItemID"  class="form-control" style="border: none;" readonly="true">
</div> 
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Cost Center</label>
<div class="col-xs-8">
<input type="text" id="IDDept" name="IDDept"  class="form-control" style="border: none;" readonly="true">
</div> 
</div>

 <div class="form-group">
    <label class="col-xs-4 control-label">Category</label>
    <div class="col-xs-8">
    <select name="CategoryID" id="CategoryID" class="form-control">
    <?php if(empty($category_name)){ ?>
  <option value=""></option>
    <?php } foreach($l_nama_category->result() as $t){ if($category_name==$t->category_name){ ?>
 <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->category_name;?></option>
    <?php }else { ?>
    <option value="<?php echo $t->id;?>"><?php echo $t->category_name;?></option>
    <?php } } ?> 
    </select>
    </div>
    </div>
    
  <div class="form-group">
  <label class="col-xs-4 control-label">Subcategory</label>
  <div class="col-xs-8">
  <select name="Hardware" id="Hardware" class="form-control">
  <?php foreach($ListHardware->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>



</div>  
<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Asset Name</label>
<div class="col-xs-8">
<input type="text" id="ItemName" name="ItemName"  class="form-control">
</div> 
</div>

 <div class="form-group">
<label class="col-xs-4 control-label">Serial Number</label>
<div class="col-xs-8">
<input type="text" id="ItemNo" name="ItemNo"  class="form-control">
</div> 
</div>

 <div class="form-group">
    <label class="col-xs-4 control-label">Location</label>
    <div class="col-xs-8">
    <select name="LocationID" id="LocationID" class="form-control">
    <?php if(empty($LocationID)){ ?>
  <option value=""></option>
    <?php }
	foreach($Location->result() as $t){ if($Location==$t->Location){ ?>
 <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Location;?></option>
    <?php }else { ?>
    <option value="<?php echo $t->SysID;?>"><?php echo $t->Location;?></option>
    <?php } } ?> 
    </select>
    </div>
    </div>
    
 <div class="form-group">
<label class="col-xs-4 control-label">Qty</label>
<div class="col-xs-4">
<input type="text" id="Qty" name="Qty"  class="form-control">
</div> 

<div class="col-xs-4">
<select name="UnitID" id="UnitID" class="form-control">
<?php if(empty($unit_name)){ ?>
<option value=""></option>
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
<label class="col-xs-4 control-label">Price</label>
<div class="col-xs-8">
<input type="text" id="Price" name="Price" class="form-control">
</div> 
</div>

 <div class="form-group">
<label class="col-xs-4 control-label">Total</label>
<div class="col-xs-8">
<input type="text" id="Amount" name="Amount"  class="form-control" readonly="true">
</div> 
</div>  

 <div class="form-group">
<label class="col-xs-4 control-label">Purchase Date</label>
<div class="col-xs-8">
<input type="text" id="PurchaseDate" name="PurchaseDate" class="form-control" readonly="true">
</div> 
</div>  

<div class="form-group">
<label class="col-xs-4 control-label">Vendor</label>
<div class="col-xs-2">
<input type="text" id="PartnerID" name="PartnerID"  class="form-control" readonly="true">
</div>
<div class="col-xs-6">
<input type="text" id="partner_code" name="partner_code"  class="form-control" readonly="true">
</div></div> 

 <div class="form-group">
 <label class="col-xs-4 control-label">Status</label>
 <div class="col-xs-8">
 <select name="IsActive" id="IsActive" class="form-control">
 <option value="1">Active</option>
 <option value="0">Non Active</option>
 </select>
 </div></div> 
    
<div class="item form-group">
<label class="col-xs-4 control-label">Specification</label>
<div class="col-xs-8">
<textarea id="Remark" name="Remark" class="form-control col-md-2 col-xs-8"  style="resize: none; height: 150px;"></textarea>
</div></div>



</div></div></div></div></div> <br />

<div id="DetailComputer">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Detail"><span class="glyphicon ">
</span> Detail Asset &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="Detail" class="collapse in">
<div class="panel-body">

<div class="col-md-6">
  
  <div class="form-group">
  <label class="col-xs-4 control-label">RAM</label>
  <div class="col-xs-8">
  <select name="RAM" id="RAM" class="form-control">
  <?php foreach($ListRAM->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Hardisk</label>
  <div class="col-xs-8">
  <select name="HDD" id="HDD" class="form-control">
  <?php foreach($ListHDD->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Grapic</label>
  <div class="col-xs-8">
  <select name="VGACard" id="VGACard" class="form-control">
  <?php foreach($ListVGA->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Network</label>
  <div class="col-xs-8">
  <select name="NetCard" id="NetCard" class="form-control">
  <?php foreach($ListNET->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Processor</label>
  <div class="col-xs-8">
  <select name="Processor" id="Processor" class="form-control">
  <?php foreach($ListProcessor->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
   <div class="item form-group">
<label class="col-xs-4 control-label">Remark</label>
<div class="col-xs-8">
<textarea id="RemarkDetail" name="RemarkDetail" class="form-control col-md-2 col-xs-8"  style="resize: none; height: 150px;"></textarea>
</div></div>

</div>
<div class="col-md-6">
 <div class="form-group">
    <label class="col-xs-4 control-label">Operating System</label>
    <div class="col-xs-8">
    <select name="OS" id="OS" class="form-control">
    <?php foreach($ListOS->result() as $t){ if($OS==$t->category_name){ ?>
 <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
    <?php }else { ?>
    <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
    <?php } } ?> 
    </select>
    </div>
    </div>

 <div class="form-group">
    <label class="col-xs-4 control-label">MS Office</label>
    <div class="col-xs-8">
    <select name="Office" id="Office" class="form-control">
    <?php foreach($ListMSO->result() as $t){ if($OS==$t->category_name){ ?>
 <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
    <?php }else { ?>
    <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
    <?php } } ?> 
    </select>
    </div>
    </div>
    
  <div class="form-group">
  <label class="col-xs-4 control-label">Autocad</label>
  <div class="col-xs-8">
  <select name="Autocad" id="Autocad" class="form-control">
  <?php foreach($ListACAD->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
    
  <div class="form-group">
  <label class="col-xs-4 control-label">NX Unigraphic</label>
  <div class="col-xs-8">
  <select name="NX" id="NX" class="form-control">
  <?php foreach($ListNX->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">SolidWorks</label>
  <div class="col-xs-8">
  <select name="SW" id="SW" class="form-control">
  <?php foreach($ListSW->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else{ ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>  
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Catia</label>
  <div class="col-xs-8">
  <select name="Catia" id="Catia" class="form-control">
  <?php foreach($ListCatia->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div> 
    
  <div class="form-group">
  <label class="col-xs-4 control-label">FTI Flash Blank</label>
  <div class="col-xs-8">
  <select name="FB" id="FB" class="form-control">
  <?php foreach($ListFB->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div> 
    
    <div class="form-group">
    <label class="col-xs-4 control-label">Database</label>
    <div class="col-xs-8">
    <select name="DB" id="DB" class="form-control">
    <?php foreach($ListDB->result() as $t){ if($OS==$t->category_name){ ?>
 <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
    <?php }else { ?>
    <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
    <?php } } ?> 
    </select>
    </div>
    </div>  
 
  
   </div>


<div class="clearfix"></div></div></div></div></div></div>

<div id="DetailPrinter">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Detail5"><span class="glyphicon ">
</span> Detail Asset &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="Detail5" class="collapse in">
<div class="panel-body">

<div class="col-md-6">
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Printer Type</label>
  <div class="col-xs-8">
  <select name="PrinterType" id="PrinterType" class="form-control">
  <?php foreach($ListPT->result() as $t){ if($PrinterType==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-xs-4 control-label">Size Paper</label>
  <div class="col-xs-8">
  <select name="SizePaper" id="SizePaper" class="form-control">
  <?php foreach($ListSP->result() as $t){ if($SizePaper==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  


</div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-xs-4 control-label">Color Type</label>
  <div class="col-xs-8">
  <select name="ColorType" id="ColorType" class="form-control">
  <?php foreach($ListCL->result() as $t){ if($ColorType==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
   </div>


<div class="clearfix"></div></div></div></div></div></div>
</form>

 <div class="panel-footer" data-toggle="btn-toggle">
 <div class="btn-group">
 <button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa  fa-save"></i>&nbsp; Save</button>
 <button type="button" id="Add" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 </div></div>
 </div></div></div>
 
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="tampil_data2"></div>
</div></div>`
</div>
 
</div>
</div></div>

 
 <div class="modal fade" id="avatar-modal">
 <div class="modal-dialog">
 <div class="modal-content">
 <form id="Upload2" enctype="multipart/form-data" role="form">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
 <h4 class="modal-title">Upload Photo</h4> </div>
 <div class="modal-body">
 <input type="text" name="ItemID2" id="ItemID2" readonly="true" class="form-control">
 <hr />
 <input type="file" name="file" id="file" class="form-control"> </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 <button type="button" id="Upload" class="btn btn-primary">Upload</button> </div>
 </form></div></div></div>
 
 <div class="modal fade" id="myModal_Partner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterListPartner"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"><div class="modal-body"><div>
<div class="row"><div class="panel-body">


<form class="form-horizontal"  name="formView" id="formView">
<div class="panel-body">

<div class="col-md-6">

 <div class="form-group">
 <label class="col-lg-4 control-label">ID</label>
<div class="col-lg-8">
<input type="text" id="ItemID3" name="ItemID3" style="border: none;"  class="form-control" readonly="true">
</div> 
</div>
    <div class="form-group">
<label class="col-lg-4 control-label">Asset Name</label>
<div class="col-lg-8">
<input type="text" id="ItemName3" name="ItemName3" style="border: none;"  class="form-control" readonly="true">
</div> 
</div>

 <div class="form-group">
<label class="col-lg-4 control-label">Serial Number</label>
<div class="col-lg-8">
<input type="text" id="ItemNo3" name="ItemNo3" style="border: none;"  class="form-control" readonly="true" >
</div> 
</div>  
  
<hr />



<div onclick="" id="Avatar3" ></div>


</div>  

<div class="col-md-6">

 <div class="form-group">
<label class="col-lg-4 control-label">Qty</label>
<div class="col-lg-4">
<input type="text" id="Qty3" name="Qty3"  class="form-control" style="border: none;" readonly="true">
</div>
 <div class="col-lg-4">
            <select name="UnitID3" id="UnitID3" class="form-control" disabled="true" style="border: none;">
            <?php if(empty($unit_name)){ ?>
  <option value=""></option>
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
<label class="col-lg-4 control-label">Price</label>
<div class="col-lg-8">
<input type="text" id="Price3" name="Price3" style="border: none;"  class="form-control" readonly="true">
</div> 
</div>

 <div class="form-group">
<label class="col-lg-4 control-label">Total</label>
<div class="col-lg-8">
<input type="text" id="Amount3" name="Amount3" style="border: none;" class="form-control" readonly="true">
</div> 
</div> 


 <div class="form-group">
<label class="col-lg-4 control-label">Purchase Date</label>
<div class="col-lg-8">
<input type="text" id="PurchaseDate3" name="PurchaseDate3" style="border: none;" class="form-control" readonly="true">
</div> 
</div> 
<div class="form-group">
<label class="col-lg-4 control-label">Vendor</label>
<div class="col-lg-8">
<input type="text" id="partner_name3" name="partner_name3"  class="form-control" readonly="true" style="border: none;">
</div></div>

 <div class="form-group">
        <label class="col-lg-4 control-label">Location</label>
        <div class="col-lg-8">
            <select name="LocationID3" id="LocationID3" style="border: none;" class="form-control" disabled="true">
            <?php if(empty($LocationID)){ ?>
  <option value=""></option>
    <?php }
	foreach($Location->result() as $t){ if($Location==$t->Location){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Location;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Location;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>

 <div class="form-group">
        <label class="col-lg-4 control-label">Category</label>
        <div class="col-lg-8">
            <select name="CategoryID3" id="CategoryID3" style="border: none;" disabled="true" class="form-control" >
            <?php if(empty($category_name)){ ?>
  <option value=""></option>
    <?php }
	foreach($l_nama_category->result() as $t){ if($category_name==$t->category_name){ ?>
     <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->category_name;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->category_name;?></option>
        <?php } } ?> 
    </select>
        </div>        
    </div>

  <div class="form-group">
  <label class="col-lg-4 control-label">SubCategory</label>
  <div class="col-lg-8">
  <select name="Hardware3" id="Hardware3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListHardware->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
      

 <div class="form-group">
<label class="col-lg-4 control-label">Cost Center</label>
<div class="col-lg-4">
<input type="text" id="Department" name="Department" style="border: none;" class="form-control" readonly="true">
</div>
<div class="col-lg-4">
<select name="IsActive3" id="IsActive3" style="border: none;" class="form-control" disabled="true">
<option value="1">Active</option>
<option value="0">Non Active</option>
</select>
</div></div> 
        
        
<div class="item form-group">
<label class="col-lg-4 control-label">Specification</label>
<div class="col-lg-8">
<textarea id="Remark3" name="Remark3" readonly="true" style="border: none; resize: none;" class="form-control col-md-2 col-xs-8"  style="resize: none; height: 100px;"></textarea>
</div></div> 

</div></div>


<div id="DetailComputer3">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Detail4"><span class="glyphicon ">
</span> Detail Asset &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="Detail4" class="collapse in">
<div class="panel-body">

<div class="col-md-6">
  
  <div class="form-group">
  <label class="col-lg-4 control-label">RAM</label>
  <div class="col-lg-8">
  <select name="RAM3" id="RAM3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListRAM->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Hardisk</label>
  <div class="col-lg-8">
  <select name="HDD3" id="HDD3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListHDD->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Grapic</label>
  <div class="col-lg-8">
  <select name="VGACard3" id="VGACard3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListVGA->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Network</label>
  <div class="col-lg-8">
  <select name="NetCard3" id="NetCard3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListNET->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Processor</label>
  <div class="col-lg-8">
  <select name="Processor3" id="Processor3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListProcessor->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
<div class="item form-group">
<label class="col-lg-4 control-label">Remark</label>
<div class="col-lg-8">
<textarea id="RemarkDetail3" name="RemarkDetail3" class="form-control col-md-2 col-xs-8" readonly="true" style="resize: none; height: 100px; border: none;"></textarea>
</div></div>


</div>
<div class="col-md-6">
 <div class="form-group">
        <label class="col-lg-4 control-label">Operating System</label>
        <div class="col-lg-8">
            <select name="OS3" id="OS3" class="form-control" style="border: none;" disabled="true" >
    <?php foreach($ListOS->result() as $t){ if($OS==$t->category_name){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>

 <div class="form-group">
        <label class="col-lg-4 control-label">MS Office</label>
        <div class="col-lg-8">
            <select name="Office3" id="Office3" class="form-control" style="border: none;" disabled="true" >
    <?php foreach($ListMSO->result() as $t){ if($OS==$t->category_name){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>
    
  <div class="form-group">
  <label class="col-lg-4 control-label">Autocad</label>
  <div class="col-lg-8">
  <select name="Autocad3" id="Autocad3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListACAD->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
    
  <div class="form-group">
  <label class="col-lg-4 control-label">NX Unigraphic</label>
  <div class="col-lg-8">
  <select name="NX3" id="NX3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListNX->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">SolidWorks</label>
  <div class="col-lg-8">
  <select name="SW3" id="SW3" class="form-control" style="border: none;" disabled="true" >
  <?php foreach($ListSW->result() as $t){ if($OS==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>  
  
  <div class="form-group">
        <label class="col-lg-4 control-label">Catia</label>
        <div class="col-lg-8">
            <select name="Catia3" id="Catia3" class="form-control" style="border: none;" disabled="true" >
    <?php foreach($ListCatia->result() as $t){ if($OS==$t->category_name){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div> 
    
  <div class="form-group">
        <label class="col-lg-4 control-label">FTI Flash Blank</label>
        <div class="col-lg-8">
            <select name="FB3" id="FB3" class="form-control" style="border: none;" disabled="true" >
    <?php foreach($ListFB->result() as $t){ if($OS==$t->category_name){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div> 
    
    <div class="form-group">
        <label class="col-lg-4 control-label">Database</label>
        <div class="col-lg-8">
            <select name="DB3" id="DB3" class="form-control" style="border: none;" disabled="true" >
    <?php foreach($ListDB->result() as $t){ if($OS==$t->category_name){ ?>
     <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
        <?php } } ?> 
    </select>
        </div>
    </div>  
     
      
   </div>


<div class="clearfix"></div></div></div></div></div></div>

<div id="DetailPrinter3">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Detail3"><span class="glyphicon ">
</span> Detail Asset &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="Detail3" class="collapse in">
<div class="panel-body">

<div class="col-md-6">
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Printer Type</label>
  <div class="col-lg-8">
  <select name="PrinterType3" id="PrinterType3" class="form-control" style="border: none;" disabled="true">
  <?php foreach($ListPT->result() as $t){ if($PrinterType==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Size Paper</label>
  <div class="col-lg-8">
  <select name="SizePaper3" id="SizePaper3" class="form-control" style="border: none;" disabled="true">
  <?php foreach($ListSP->result() as $t){ if($SizePaper==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
  
  


</div>
<div class="col-md-6">
<div class="form-group">
  <label class="col-lg-4 control-label">Color Type</label>
  <div class="col-lg-8">
  <select name="ColorType3" id="ColorType3" class="form-control" style="border: none;" disabled="true">
  <?php foreach($ListCL->result() as $t){ if($ColorType==$t->category_name){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
  <?php } } ?> 
  </select>
  </div>
  </div>
   </div>


<div class="clearfix"></div></div></div></div></div></div>

 

    <div class="panel-footer">

    <?php  $cek = $this->session->userdata('CanEditMaster')=='1'; if(!empty($cek)){ ?>
    <a  onclick="PilihEditSearch()" href="#tab_content2" data-toggle="tab" aria-expanded="false"  class="btn btn-warning">
    <i class="glyphicon glyphicon-edit"></i> Edit</a>
    <?php } ?>
    
        <button type="button" name="Print3" id="Print3" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Print</button>
        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-danger"><i class="fa fa-close (alias)"></i> Closed</button> 
   
   <form class="navbar-right" role="search">
   <div class="col-md-6">
    <div class="form-group">
    <label class="col-lg-3 control-label">Created By</label>
    <div class="col-lg-6">
    <input type="text" id="CreatedBy" name="CreatedBy" class="form-control" placeholder="Created By" readonly="true"></div>
    </form>
   
    </div>
</div>

</form>
</div></div></div></div></div></div></div></div>

 <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
 <h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
     
 <div id="pesanDelete"></div>
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
 
 <div class="modal fade" id="myModalDelete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
 <h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
     
 <div id="pesanDelete2"></div>
 <div style="font-size: larger; font-weight: bold;" id="PartNoDelete2"></div>
 <br /><br /><br />
 <div class="panel-footer">
 <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Batal</button>
 <button type="button" name="Hapus2" id="Hapus2" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ok</button>
 <form class="navbar-right" role="search">
 <div class="form-group">
 <input type="text" id="DocNumDetailDelete2" name="DocNumDetailDelete2" class="form-control" readonly="true" ></div>
 </form>
 </div>
 </div></div></div></div></div><!-- /.modal -->

<script type="text/javascript"> 
function PilihEdit(id){
 $("#ItemID").val(id);
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click();
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click();
 },300) ;
 },500) ;
 return false();
 }
</script>

<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo){
    $("#DocNumDetailDelete").val(DocNumDetail);
     $("#myModalDelete").modal('show');
     $("#pesanDelete").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete").text(PartNo); 
	};
    </script>

<script type="text/javascript"> 
function PilihHapus2(DocNumDetail,PartNo){
    $("#DocNumDetailDelete2").val(DocNumDetail);
     $("#myModalDelete2").modal('show');
     $("#pesanDelete2").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete2").text(PartNo); 
	};
    </script>
    
<script type="text/javascript"> 
function PilihView(id, dept){
 document.body.style.cursor = 'wait';
 $("#myModal_Search").modal("show");
 if(dept!='ICT'){$("#FormAdd").hide();}else{$("#FormAdd").show();}
 $("#ItemID3").val(id);    
 setTimeout(function(){
 $("#ItemID3").focus();
 $("#ItemID3").click();
 document.body.style.cursor = 'default'; },300)
 return false(); }
</script>

<script type="text/javascript">     
function PilihEditSearch(){
 var ItemID3 = $("#ItemID3").val();
 $("#myModal_Search").modal("hide");
 $("#ItemID").val(ItemID3);
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click();
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click();
 },300) ;
 },500) ;  return false(); }
</script>

<script type="text/javascript"> 
function AvatarUpload(){
 var ItemID	    = $("#ItemID").val();
 $("#ItemID2").val(ItemID);
 $("#avatar-modal").modal('show');
 return false(); }
</script>

<script>
$('#Upload').click(function(e){
 var form = $('#Upload2');
 var formdata = false;
 if(window.FormData){
 formdata = new FormData(form[0]); }
 var formAction = form.attr('action');
 $("#avatar-modal").modal('hide');
 $.ajax({
 type        : 'POST',
 url         : '<?php echo site_url(); ?>/MasterAsset/Upload',
 cache       : false,
 data        : formdata ? formdata : form.serialize(),
 contentType : false,
 processData : false,
 success	: function(data){
 $("#ItemID").focus();
 $("#ItemID").click();
 },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); }
 }); e.preventDefault(); });
</script>

<script type="text/javascript">     
function Search(){
    
    
    
    var DocNumSearch2 	    = $("#DocNumSearch").val();
    if(DocNumSearch2.match('SAI-ASSET')){
            DocNumSearch = $("#DocNumSearch").val();
        }else{
            DocNumSearch = ('SAI-ASSET'+DocNumSearch2);
            $("#DocNumSearch").val('SAI-ASSET'+DocNumSearch2);
        }
        
    if(DocNumSearch.length==0){
      $("#myModal4").modal('show');
      $("#pesan4").text('Masukan No Barcode');  
    }else{
    $("#myModal_Search").modal("show");
	$("#ItemID3").val(DocNumSearch);
    setTimeout(function(){
					$("#ItemID3").focus();
					$("#ItemID3").click();
                    
          setTimeout(function(){
					$("#ItemID3").focus();
					$("#ItemID3").click();
				},300) ;
				},500) 
			return false(); 
	 }
    }
</script>

<script>
$(function () {
 $("#LocationIDView").select2();  $("#DeptIDView").select2();
$('#PurchaseDate').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });
$('#SJDate').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });

  });
</script> 