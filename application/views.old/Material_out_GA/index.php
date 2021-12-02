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
            volume: 1.0
        });

    });
</script>
  
<script type="text/javascript">
$(document).ready(function(){
 tampil_data();
$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });

$('#reload1').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 Detail_data2(); }, 500); });

$("#Home2").click(function() {
setTimeout(function() {
$('#reload').click(); }, 100); });

$("#Home").click(function() {
setTimeout(function() {
$('#reload').click(); }, 100); });

$("#Home3").click(function() {
setTimeout(function() {
$('#reload').click(); }, 100); });

$("#AddDetail").on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 AmbilFormDetail();
}, 500); });
    
function tampil_data(){
var kode = "";
$('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/transaction_list",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#transaction_list").html(data);
$('#reload').button('reset');  } }); };
 

$("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){ $("#DocNumSearchButton").click(); } });

$("#DocNumDetail2").focusout(function(){
 var  DocNumDetail2 = $("#DocNumDetail2").val();
 if(DocNumDetail2.length==0){
 AmbilForm();
 Detail_data();} });    

$("#DocNumDetail2").focus(function(e){
 var isi = $(e.target).val();
 AmbilFormEdit(); Detail_data(); });

$("#DocNumDetail2").keyup(function(){
 AmbilFormEdit(); Detail_data(); });
    
    $("#DocNumDetail2").click(function(e){
    var isi = $(e.target).val();
	AmbilFormEdit();
    Detail_data();
	 });
     
    $("#Spec1").click(function(e){
    var isi = $(e.target).val();
    Detail_data();
	 });
    $("#Spec1").focus(function(e){
	var isi = $(e.target).val();
    Detail_data();
	});
    
function AmbilFormEdit(){
 var kode = $("#DocNumDetail2").val();
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ref_json/InfoDataEdit",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate); 
 $("#Category").val(data.Category);
 $("#CanEdit").val(data.CanEdit); 
 $("#DocNum").val(data.DocNum); 
 $("#DocNumDetail").val(data.DocNumDetailGAOut);
 $("#DocNumDetail3").val(data.DocNumDetail3); 
 $("#ItemID").val(data.ItemID);
 $("#ItemIDExt").val(data.ItemIDExt);   
 $("#PartNo").val(data.PartNo); 
 $("#PartName").val(data.PartName);  
 $("#IDCust").val(data.IDCust); 
 $("#CustName").val(data.Code);   
 $("#IDProject").val(data.IDProject); 
 $("#Spec1").val(data.Spec1);
 $("#Spec2").val(data.Spec2); 
 $("#MatNum").val(data.MatNum); 
 $("#PartnerID").val(data.PartnerID);
 $("#partner_code").val(data.partner_code); 
 $("#MaterialType").val(data.MaterialType);
 $("#MaterialName").val(data.MaterialName); 
 $("#PcsPerSheet").val(data.PcsPerSheet);
 $("#PcsPerKg").val(data.PcsPerKg); 
 $("#DocNumExt").val(data.SourceDocNum); 
 $("#QtyMat").val(data.QtyMat);
 $("#QtyPcs").val(data.QtyPcs); 
 $("#NGMat").val(data.NGMat); 
 $("#BalMatBe").val(data.QtyMat);
 $("#BalPcsBe").val(data.QtyPcs); 
 $("#BalAmountBe").val(data.BalAmount); 
 $("#BalMatSource").val(data.BalMatSource);
 $("#BalAmountSource").val(data.BalAmountSource); 
 $("#StockMat").val(data.BalMatSource);
 $("#StockAmount").val(data.BalAmountSource); 
 $("#BalMat").val(data.BalMatSource);
 $("#BalAmount").val(data.BalAmountSource);
 $("#Price").val(data.Amount); 
 $("#IDPic").val(data.IDPic);
 $("#PicName").val(data.nama_singkat);
 }  });  };
             
$("#DocNum2").focus(function(e){ var isi = $(e.target).val(); Detail_data2(); });
$("#DocNum2").keyup(function(){ Detail_data2();	 });
$("#DocNum2").keyup(function(){ Detail_data2();	 });

function Detail_data2(){
var kode = $("#DocNum2").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/transaction_detail_2",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#Detail_data2").html(data);
waitingDialog3.hide(); } }); }


$("#AddDetail").focus(function(e){
 var isi = $(e.target).val();
 Detail_data(); AmbilFormDetail(); });
$("#AddDetail").keyup(function(){
 Detail_data(); AmbilFormDetail();	 });
    
function Detail_data(){
var kode = $("#DocNum").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/transaction_detail",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#Detail_data").html(data);
waitingDialog3.hide(); } }); }
    
$("#DocNumModalSearch").focus(function(e){
var isi = $(e.target).val(); DetailSearch(); });
$("#DocNumModalSearch").keyup(function(){ DetailSearch();	 });
$("#DocNumModalSearch").keyup(function(){ DetailSearch();	 });
function DetailSearch(){ var kode = $("#DocNumModalSearch").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/List_Material",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#List_Material").html(data); 	} }); }
    
$("#QtyMat").focus(function(){ var  QtyMat = $("#QtyMat").val();
 if(QtyMat == 0){ $("#QtyMat").val(""); return false(); }  });

$("#QtyMat").focusout(function(){ var  QtyMat = $("#QtyMat").val();
 if(QtyMat.length==0){ $("#QtyMat").val("0"); return false(); }  });


$("#DocNum2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#DocNumDetail2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#SJNum").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PONum").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#MatNum").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PartnerID2").keypress(function(data){ 
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });

$("#QtyMat").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
        
        
        
function hitung(){
 var BalMat = $("#BalMat").val();
 var BalMatBe = $("#BalMatBe").val();
 var BalAmountBe = $("#BalAmountBe").val();
 var QtyMat = $("#QtyMat").val();
 var StockMat = $("#StockMat").val();
 var StockAmount = $("#StockAmount").val();
 var BalMat =  (parseFloat(StockMat) + parseFloat(BalMatBe)) - parseFloat (QtyMat) ;
 $("#BalMat").val(BalMat);
 var BalAmount = (parseFloat(StockAmount) + parseFloat(BalAmountBe)) - ((parseFloat(StockAmount) / parseFloat(StockMat)) * parseFloat(QtyMat)) ;
 $("#BalAmount").val(BalAmount);
 var Price = ((parseFloat (StockAmount) / parseFloat(StockMat)) * parseFloat(QtyMat));
 $("#Price").val(Price);
 }
        
$("#QtyMat").keyup(function(){
hitung(); });

$("#home-tab").click(function(){
    var win = $("#myModal100").modal('show');
 setTimeout(function(){
     tampil_data();
					$("#myModal100").modal('hide');
				},1000)
    });	
    
$("#home-tab2").click(function(){
   waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     tampil_data();
      setTimeout(function(){
     waitingDialog3.hide();
				},200) ;
				},1000)
    });	
    
$("#home-tab3").click(function(){
   waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     tampil_data();
      setTimeout(function(){
     waitingDialog3.hide();
				},200) ;
				},1000)
    });
    
$("#form-tab").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#Spec1").focus();
					$("#Spec1").click();
     waitingDialog3.hide();
				},300) ;
      ta}, 1000);
    
    });	
    
    $("#form-tab2").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#Spec1").focus();
					$("#Spec1").click();
     
				},300) ;
     ta}, 1000);
    
    });
    
    $("#form-tab3").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#Spec1").focus();
					$("#Spec1").click();
     
				},300) ;
     ta}, 1000);
    
    });
    
    
function AmbilForm(){
 var kode = "";
 $.ajax({
 type : 'POST',
 url : "<?php echo site_url(); ?>/ref_json/InfoTambahFormGAMatOut",
 data : "kode="+kode,
 cache : false,
 dataType : "json",
 success	: function(data){
 $("#DocNum").val(data.DocNum);
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#DocDate").val(data.DocDate);
 $("#CreateTime").val(data.CreateTime);
 $("#SJDate").val(data.CreateDate);
 $("#Category").val("");
 $("#CanEdit").val("0");
 $("#DocNumDetail3").val(""); 
 $("#DocNumDetail2").val("");
 $("#ItemID").val("");
 $("#PartNo").val("");
 $("#PartName").val("");
 $("#IDCust").val("");
 $("#CustName").val("");
 $("#Spec1").val("");
 $("#Spec2").val("");
 $("#PcsPerDay").val("");
 $("#PcsPerSheet").val("");
 $("#PcsPerKg").val("");
 $("#SJNum").val("");
 $("#DocNumExt").val("");
 $("#MatNum").val("");
 $("#PartnerID").val("");
 $("#partner_code").val("");
 $("#QtyMat").val("0");
 $("#QtyPcs").val("0");
 $("#BalMat").val("0");
 $("#BalPcs").val("0");
 $("#BalMatBe").val("0");
 $("#BalPcsBe").val("0");
 $("#BalMatSourceAf").val("0");
 $("#BalPcsSourceAf").val("0");
 $("#BalMatSource").val("0");
 $("#BalPcsSource").val("0"); 
 $("#BalMatBe").val("0");
 $("#BalAmountBe").val("0");
 $("#BalPcsBe").val("0");
 $("#BalMatAf").val("0");
 $("#BalPcsAf").val("0");
 $("#NGMat").val("0");
 $("#ItemIDExt").val("");
 $("#BalAmountSource").val("0");   
 $("#StockMat").val("0");
 $("#StockAmount").val("0");
 $("#BalAmount").val("0");
 $("#BalAmountBe").val("0");
 $("#BalAmountSource").val("0");    
 $("#MaterialType").val("");
 $("#MaterialName").val("");
 $("#Price").val("0");
 $("#IDPic").val("");
 $("#PicName").val("");
 }  });  };
             
       
   function AmbilFormDetail(){
		var kode = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormDetailGAMatOut",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
   
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#SJDate").val(data.CreateDate);
 $("#Category").val("");
 $("#CanEdit").val("0");
 
 $("#DocNumDetail2").val("");
 $("#DocNumDetail3").val("");
 $("#QtyMatBefore").val("0"); 
 
 $("#ItemID").val("");
				$("#ItemIDExt").val("");
				$("#PartNo").val("");
 $("#PartName").val("");
 $("#IDCust").val("");
 $("#CustName").val("");
 $("#Spec1").val("");
 $("#Spec2").val("");
 $("#PcsPerDay").val("");
 $("#PcsPerSheet").val("");
 $("#PcsPerKg").val("");
 $("#SJNum").val("");
 $("#DocNumExt").val("");
 $("#MatNum").val("");
 $("#QtyMat").val("0");
 $("#QtyPcs").val("0");
 $("#BalMat").val("0");
 
 $("#BalPcs").val("0");
 $("#BalMatBe").val("0");
 $("#BalPcsBe").val("0"); 
 $("#StockMat").val("0");
 $("#StockAmount").val("0");
 $("#BalAmount").val("0");
 $("#BalAmountBe").val("0");
 $("#BalAmountSource").val("0"); 
 $("#Price").val("0");
 
 $("#BalMatSourceAf").val("0");
 $("#BalPcsSourceAf").val("0");
 $("#BalMatSource").val("0");
 $("#BalPcsSource").val("0");  
 $("#BalPcsBe").val("0");
 $("#BalMatAf").val("0");
 $("#BalPcsAf").val("0");
 $("#NGMat").val("0");
 
 $("#ItemIDExt").val("");
 
 $("#IDPic").val("");
 $("#PicName").val("");
 
 $("#MaterialType").val("");
 $("#MaterialName").val("");           
			 }  });  };
             
    
$("#ItemID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
$("#ItemID").keyup(function(){ CariProfilProduct();	 });
function CariProfilProduct(){
var kode = $("#ItemID").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/InfoMaterial_product",
data	: "kode="+kode,
cache	: false,
dataType : "json",
success	: function(data){
$("#PartNo").val(data.PartNo);
$("#PartName").val(data.PartName);
$("#Unit").val(data.Unit); 
$("#Category").val(data.Category); 
$("#Spec1").val(data.Spec1);
$("#Spec2").val(data.Spec2); 
$("#QtyMat").val("0");
$("#Price").val(data.Price);
$("#Amount").val("0"); 
$("#PartNo2").val(data.PartNo);
$("#PartName2").val(data.PartName);
$("#SpecReport").val(data.Spec);
}  });  };
             
$("#PartnerID").focus(function(e){ var isi = $(e.target).val(); CariProfilPartner(); });
$("#PartnerID").keyup(function(){ CariProfilPartner();	 });
	
function CariProfilPartner(){
var kode = $("#PartnerID").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/InfoPartner",
data	: "kode="+kode,
cache	: false,
dataType : "json",
success	: function(data){
$("#partner_code").val(data.partner_code);
$("#partner_name").val(data.partner_name); }  });  };
             
$("#DocNumExt").focus(function(e){
		var isi = $(e.target).val();
        var DocNumDetail3 = $("#DocNumDetail3").val();
        if(DocNumDetail3.length==0){
		CariListMaterialOut(); }
	});
	$("#DocNumExt").keyup(function(){
	   var DocNumDetail3 = $("#DocNumDetail3").val();
	   if(DocNumDetail3.length==0){
		CariListMaterialOut();	}
	});
	
	function CariListMaterialOut(){
		var kode = $("#DocNumExt").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoDataEdit",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#ItemIDExt").val(data.ItemID);
 $("#ItemID").val(data.ItemID);
 $("#PartNo").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#IDCust").val(data.IDCust);
 $("#CustName").val(data.Code)
 $("#Spec1").val(data.Spec1);
 $("#Spec2").val(data.Spec2);
 $("#Category").val(data.Category);
 $("#PcsPerSheet").val(data.PcsPerSheet);
 $("#PcsPerKg").val(data.PcsPerKg);
 $("#BalMatSource").val(data.BalMat);
 $("#BalPcsSource").val(data.BalPcs);
 $("#MaterialType").val(data.MaterialType);
 $("#MaterialName").val(data.MaterialName);
  
 $("#BalMatBe").val("0");
 $("#BalPcsBe").val("0");
 $("#BalMatAf").val("0");
 $("#BalPcsAf").val("0");
 $("#NGMat").val("0");
 
 $("#QtyMat").val("0");
 $("#QtyPcs").val("0");
 $("#BalMat").val("0");
 $("#BalPcs").val("0");
 $("#BalMatBe").val("0");
 $("#BalPcsBe").val("0");
 $("#DocNumDetail2").val("");
 $("#DocNumDetail3").val("");
 $("#BalAmount").val("0");
 $("#Price").val("0");
 
 $("#StockMat").val(data.BalMat);
 $("#StockAmount").val(data.BalAmount);
 
			 }  });  };
             
$("#code").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#unit").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });

$("#Save").click(function(){
 var DocNum 	    = $("#DocNum").val();
 var DocNumExt 	= $("#DocNumExt").val();
 var BalMat 	    = $("#BalMat").val();
 var QtyMat 	    = $("#QtyMat").val();
 var PartNo 	    = $("#PartNo").val();
 var IDPic 	    = $("#IDPic").val();
 var ItemID 	    = $("#ItemID").val();
 var Price 	    = $("#Price").val();
 var CanEdit         = $("#CanEdit").val(); 
 var string = $("#form").serialize();
 if(DocNum.length==0){ NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); return false(); }
 if(CanEdit>0){ NotifFail('Dokumen ini tidak bisa diedit/hapus, sudah digunakan');  return false(); }
 if(DocNum.length==0){ NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi');  return false(); }
 if(DocNumExt.length==0){ NotifFail('Ref No Harus di isi');  return false(); }
 if(ItemID.length==0){ NotifFail('Silahkan klik "PartNo" untuk mengisi product'); return false(); }
 if(IDPic.length==0){ NotifFail('PIC tidak boleh di kosongkan');   return false(); }
 if(QtyMat==0){ NotifFail('Qty Product tidak boleh di kosongkan'); return false(); }
 if(QtyMat.length==0){ NotifFail('Qty Product tidak boleh di kosongkan');  return false(); }
 if(BalMat<0){ NotifFail('Check Qty Product');  return false(); }    
 if(isNaN(Price)){ NotifFail('Isi sesuai perintah !'); return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});   	
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/Material_out_GA/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 Detail_data(); AmbilFormDetail();
 NotifSuccsess(data); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); return false(); });
    
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
      
    
$("#Search").click(function(){
 var IDCategory = $("#IDCategory").val();
 var IDDepartment = $("#IDDepartment").val();
 var ItemID = $("#ItemID2").val();
 var PartName = $("#PartName2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCategory="+IDCategory+"&tgl1="+tgl1+"&tgl2="+tgl2+"&IDDepartment="+IDDepartment+"&ItemID="+ItemID;
		
 if(tgl1.length==0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length==0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 $("#detail_report").html('');
 $.ajax({
 type	 : 'POST',
 url	 : "<?php echo site_url(); ?>/Material_out_GA/ReadReport",
 data	 : string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#detail_report").html(data); },2000) } });
 return false(); });
 
$("#ExportList3").click(function(){
 var IDCategory = $("#IDCategory").val();
 var IDDepartment = $("#IDDepartment").val();
 var ItemID = $("#ItemID2").val();
 var PartName = $("#PartName2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCategory+"/"+IDDepartment+"/"+ItemID;
 if(tgl1.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); } 

 window.open('<?php echo site_url();?>/Material_out_GA/ExportReport/'+string); return false(); });
    

             
$("#HapusDetail").click(function(){
    var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
    var CanEditDelete         = $("#CanEditDelete").val();
    var BalMatSourceAF         = $("#BalMatSourceAF").val();
    var BalAmountSourceAF         = $("#BalAmountSourceAF").val();
    var DocNum_ExtDelete         = $("#DocNum_ExtDelete").val();
    
if(CanEditDelete>0){
NotifFail('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
$("#myModalDelete").modal('hide');  
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/Hapus_Detail",
data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&CanEditDelete="+CanEditDelete+"&BalMatSourceAF="+BalMatSourceAF+"&BalAmountSourceAF="+BalAmountSourceAF+"&DocNum_ExtDelete="+DocNum_ExtDelete,
cache	: false,
success	: function(data){
setTimeout(function(){
NotifSuccsess(data); 
$("#DocNum2").click(); $("#DocNum2").focus();
AmbilFormDetail(); Detail_data() ; },300) },
error : function(xhr, teksStatus, kesalahan) {
$("#myModal4").modal('show');
$("#pesan4").text('Server tidak merespon :'+kesalahan); } 	}); return false();	 });
    

 $('#ExportList').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 var kode	= $("#DocNum2").val();
 window.open('<?php echo site_url();?>/Material_out_GA/PrintList/'+kode);
 return false();	
 }, 500); });
 
 $('#ExportList2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 var kode	= $("#DocNum").val();
 window.open('<?php echo site_url();?>/Material_out_GA/PrintList/'+kode);
 return false();	
 }, 500); });

$("#IDPic").focus(function(e){ var isi = $(e.target).val(); CariListPicTR(); });
$("#IDPic").keyup(function(){ CariListPicTR(); });
function CariListPicTR(){
 var kode3 = $("#IDPic").val();
 $.ajax({
 type	  : 'POST',
 url	  : "<?php echo site_url(); ?>/ref_json/InfoListPicTR",
 data	  : "kode3="+kode3,
 cache	  : false,
 dataType : "json",
 success	: function(data){
 $("#IDPic").val(data.IDPic);
 $("#PicName").val(data.code);
 }  });  };
             
function MasterList(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };

function MasterList2(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/MasterList2",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList2").html(data);	} }); };

function MasterListPic(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out_GA/MasterListPic",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterListPic").html(data);	} }); };
    
$("#DocNumExt").click(function(){ 
var DocNumDetail3 = $("#DocNumDetail3").val();
if(DocNumDetail3.length==0){ $("#myModal_product").modal('show'); MasterList(); return false(); } });

$("#PartNo").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#IDPic").click(function(){ $("#myModal_Pic").modal('show'); MasterListPic(); });
$("#ItemID2").click(function(){ $("#myModal_product2").modal('show'); MasterList2();});
$("#PartNo2").click(function(){ $("#myModal_product2").modal('show'); MasterList2(); });

        $("#DocNumExt").click(function(){
        var DocNumDetail3 = $("#DocNumDetail3").val();
        
        
        if(DocNumDetail3.length==0){ $("#myModal_MaterialList").modal('show'); return false(); }
		
	});
    
$("#PartnerID").click(function(){ $("#myModal_Partner").modal('show'); });
$("#Reload1").click(function(){ $("#DocNum2").focus(); });

$("#empty").click(function(){
 $("#ItemID2").val(""); 
 $("#PartNo2").val("");
 $("#PartName2").val(""); 
 $("#Spec12").val(""); });
           
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

<a href="#tab_content4" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa fa-folder-open"></i>&nbsp; Report</a>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="transaction_list"></div>
</div></div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal"  name="form" id="form">
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
<label class="col-xs-4 control-label">DocNum</label>
<div class="col-xs-5">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-3">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="StockMat" name="StockMat"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="StockAmount" name="StockAmount"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance Before</label>
<div class="col-xs-4">
<input type="text" id="BalMatBe" name="BalMatBe"  class="form-control" readonly="readonly" value="0" >
</div>
<div class="col-xs-4">
<input type="text" id="BalAmountBe" name="BalAmountBe"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance</label>
<div class="col-xs-4">
<input type="text" id="BalMat" name="BalMat"  class="form-control" readonly="readonly" >
</div>
<div class="col-xs-4">
<input type="text" id="BalAmount" name="BalAmount"  class="form-control" readonly="readonly">
</div> </div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">CreateDate</label>
<div class="col-xs-8">
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocTime</label>
<div class="col-xs-8">
<input type="text" id="CreateTime" name="CreateTime"  class="form-control" readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-xs-4 control-label">DocDate</label>
<div class="col-xs-8">
<input type="text" id="DocDate" name="DocDate"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-4">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CanEdit" name="CanEdit"  class="form-control" readonly="readonly">
</div></div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="product" class="collapse in">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Ref. No</label>
<div class="col-xs-5">
<input type="text" id="DocNumExt" name="DocNumExt"  class="form-control" readonly="true">
</div>
<div class="col-xs-3">
<input type="text" id="ItemIDExt" name="ItemIDExt"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Product No</label>
<div class="col-xs-2">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-6">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Product Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<input type="text" id="Spec1" name="Spec1"  class="form-control" readonly="readonly">
</div>
</div>
</div> 
<div class="col-md-6">
 <div class="form-group">
<label class="col-xs-4 control-label">Category</label>
<div class="col-xs-8">
<input type="text" id="Category" name="Category"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Pic</label>
<div class="col-xs-4">
<input type="text" id="IDPic" name="IDPic"  class="form-control" readonly="true" >
</div>
<div class="col-xs-4">
<input type="text" id="PicName" name="PicName"  class="form-control" placeholder="Nama Pic" readonly="true">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty</label>
<div class="col-xs-4">
<input type="text" id="QtyMat" name="QtyMat"  class="form-control" value="0" placeholder="Qty Keluar">
</div>
<div class="col-xs-4">
<input type="text" id="Price" name="Price"  class="form-control" readonly="true">
</div> 
</div>
</div>
</div></div></div></div></form>


<div class="box-body panel-footer">

<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<button type="button" id="Save" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-save"></i>&nbsp; Save</button>
<button type="button" id="AddDetail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="ExportList2" id="ExportList2" class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<a href="#tab_content1" role="tab" id="Home"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>
</div></div>


<form class="pull-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetail2" name="DocNumDetail2" class="form-control" placeholder="Search"></div>
</form>

</div>

</div></div></div>

<div class="box-body"><div class="box"><div class="box-body">
<div id="Detail_data"></div>
</div></div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a onfocus="PilihTambah()" href="#tab_content2" role="tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa fa-plus"></i>&nbsp; Add</a> <?php } ?>
<button type="button" name="ExportList" id="ExportList" class="btn btn-success"data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..."><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<button type="button" class="btn btn-info" id="reload1" name="reload1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
<a href="#tab_content1" role="tab" id="Home2"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a> </div> </div>
<div class="pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNum2" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body"> 
<div id="Detail_data2"></div> 
</div></div></div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="report-tab">
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
            

<div class="form-group">
<label class="col-xs-4 control-label">Department</label>
<div class="col-xs-8">
<select name="IDDepartment" id="IDDepartment" class="form-control" style="width: 100%;">
<option value="semua">All Department</option>
<?php foreach($MListDepartment->result() as $t){?>
<option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option>
<?php } ?></select>
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Category</label>
<div class="col-xs-8">
<select name="IDCategory" id="IDCategory" class="form-control" style="width: 100%;">
<option value="semua">All Category</option>
<?php foreach($MListCategory->result() as $t){?>
<option value="<?php echo $t->id;?>"><?php echo $t->category_name;?></option>
<?php } ?></select>
</div></div> 
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-3">
<input type="text" id="ItemID2" name="ItemID2"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" readonly="true" >
</div><button type="button" name="empty" id="empty" class="btn btn-danger"><i class="fa fa-trash"></i></button>
</div>

    <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName2" name="PartName2"  class="form-control" readonly="true">
</div></div>
    <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<input type="text" id="Spec12" name="Spec12"  class="form-control" readonly="true">
</div></div>
</div>
</div>
</div></div></div>
</form>
</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" name="ExportList3" id="ExportList3" class="btn btn-success"data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..."><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>      
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-warning">
<i class="fa fa-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>
</div></div></div></div></div>
</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="detail_report"></div>
</div></div></div>
</div>

</div></div>


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
 <input hidden="true" type="text" id="DocNumDetailDelete" name="DocNumDetailDelete"  readonly="true" >
 <input hidden="true" type="text" id="BalMatSourceAF" name="BalMatSourceAF" readonly="true" >
 <input hidden="true" type="text" id="BalAmountSourceAF" name="BalAmountSourceAF" readonly="true" >
 <input hidden="true" type="text" id="DocNum_ExtDelete" name="DocNum_ExtDelete" readonly="true" ></div>
 </form>
 </div>
</div></div></div></div></div><!-- /.modal -->


<div class="modal fade" id="myModal_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>


<div class="modal fade" id="myModal_product2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList2"></div>
</div></div></div></div></div></div></div>

<div class="modal fade" id="myModal_Pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterListPic"></div>
</div></div></div></div></div></div></div>


<script type="text/javascript"> 
function PilihTambah(){
 var  DocNum2 = $("#DocNum2").val(); 
 setTimeout(function(){
 $("#DocNum").val(DocNum2);
 $("#myModal_Search").modal("hide");
 setTimeout(function(){
 $("#AddDetail").focus();
 $("#AddDetail").click();
 Detail_data();
 },300) ;
 },500) 
 return false(); }
</script>
<script type="text/javascript"> 
function PilihTambah2(){
 var  DocNum2 = $("#DocNumModalSearch").val(); 
 setTimeout(function(){
 $("#DocNum").val(DocNum2);
 $("#myModal_Search").modal("hide");
 setTimeout(function(){
 $("#AddDetail").focus();
 $("#AddDetail").click();
 Detail_data(); },300) ; },500) 
 return false(); }
</script>




<script>
 $(function () {
 $("#PartnerID2").select2();  $("#IDCategory").select2(); $("#IDDepartment").select2();
 $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
 $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
 $("[data-mask]").inputmask();
 $('#reservation').daterangepicker();
 $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
 $('#daterange-btn').daterangepicker({
 ranges: {
 'Today': [moment(), moment()],
 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
 'This Month': [moment().startOf('month'), moment().endOf('month')],
 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')] },
 startDate: moment().subtract(29, 'days'),
 endDate: moment() },
 function (start, end) {
 $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')); } );
 $('#DocDate').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });
 $('#SJDate').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });
 $('#tgl1').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });
 $('#tgl2').datepicker({
 autoclose: true,
 format: "dd-mm-yyyy" });

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
<script type="text/javascript">
function pilih3(id){
$("#myModal_product").modal("hide");
$("#DocNumExt").val(id);
$("#DocNumExt").focus(); }
</script>
<script type="text/javascript"> 
function PilihEdit(id){
 $("#DocNumDetail2").val(id);
 $("#DocNumDetail").val(id.substr(13,3));
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 },300) ;
 },500) 
 return false(); }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,CanEdit){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
$("#CanEditDelete").val(CanEdit);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
<script type="text/javascript">
function pilih2(id){
$("#myModal_Pic").modal("hide");
$("#IDPic").val(id);
$("#IDPic").focus(); }
</script>

<script type="text/javascript"> 
function PilihEdit(id){
 $("#DocNumDetail2").val(id);
 $("#DocNumDetail").val(id.substr(14,3));
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 },300) ; },500) 
 return false(); }
</script>

<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,QtyMat,Amount,BalMatSource,BalAmountSource,CanEditDelete,SourceDocNum){
var BalMatSourceAF = parseFloat(QtyMat) + parseFloat(BalMatSource) ;
var BalAmountSourceAF = parseFloat(Amount) + parseFloat(BalAmountSource) ;
$("#myModalDelete").modal('show');
$("#DocNumDetailDelete").val(DocNumDetail);
$("#CanEditDelete").val(CanEditDelete);
$("#BalMatSourceAF").val(BalMatSourceAF);
$("#BalAmountSourceAF").val(BalAmountSourceAF);
$("#DocNum_ExtDelete").val(SourceDocNum);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>

<script> $(function () { $("#t_list_master").DataTable(); });</script>
<script> $(function () { $("#t_list_master_partner1").DataTable(); });</script>
<script> $(function () { $("#t_list_master_partner2").DataTable(); });</script> 
<script> $(function () { $("#t_list_master_2").DataTable(); });</script>