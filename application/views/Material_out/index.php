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
$("#TutupComment").click(function(){
$("#myModalCom").modal('hide');
tampil_data(); }); 

function reloadAja() { tampil_data(); } ;
$("#DocNumSearch").keyup(function(event){
if(event.keyCode == 13){ $("#DocNumSearchButton").click(); } });
     
$("#QtyMat").focus(function(){
var QtyMat = $("#QtyMat").val();
if(QtyMat == 0){ $("#QtyMat").val(""); return false(); }  });
$("#QtyMat").focusout(function(){ var  QtyMat = $("#QtyMat").val();
if(QtyMat.length==0){ $("#QtyMat").val("0"); return false(); }  });

$("#NGMat").focus(function(){
var NGMat = $("#NGMat").val();
if(NGMat == 0){ $("#NGMat").val(""); return false(); }  });
$("#NGMat").focusout(function(){ var  NGMat = $("#NGMat").val();
if(NGMat.length==0){ $("#NGMat").val("0"); return false(); 	}  });

$("#DocNumDetail2").focusout(function(){
var  DocNumDetail2 = $("#DocNumDetail2").val();
if(DocNumDetail2.length==0){
AmbilForm(); 
setTimeout(function(){
tampil_data_detail();
hitung(); },300) ; } });    
$("#DocNumDetail2").focus(function(e){
var isi = $(e.target).val();
AmbilFormEdit();
setTimeout(function(){
tampil_data_detail(); hitung(); },300) ; });
$("#DocNumDetail2").keyup(function(){
AmbilFormEdit(); 
setTimeout(function(){
tampil_data_detail(); hitung(); },300) ; });

$("#DocNumDetail2").keydown(function(){
AmbilFormEdit();  setTimeout(function(){
tampil_data_detail(); hitung(); },300) ; });
    
$("#DocNumDetail2").click(function(e){
var isi = $(e.target).val();
AmbilFormEdit(); 
setTimeout(function(){
tampil_data_detail(); hitung(); },300) ; });
     
$("#Spec").click(function(e){
var isi = $(e.target).val();
tampil_data_detail(); });

function AmbilFormEdit(){
var x = $("#DocNumDetail2").val();
var y = "BSTM" ;
if(x.match(y)){
var kode = $("#DocNumDetail2").val();
}else{ var kode = "" ;    }
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/InfoDataEdit",
data	: "kode="+kode,
cache	: false,
dataType : "json",
success	: function(data){
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#DocNum").val(data.DocNum); 
 $("#DocNumDetail").val(data.DocNumDetailOut);
 $("#DocNumDetail3").val(data.DocNumDetail3); 
 $("#ItemID").val(data.ItemID);
 $("#ItemIDExt").val(data.ItemID);
 $("#CanEdit").val(data.CanEdit);  
 $("#PartNo").val(data.PartNo); 
 $("#PartName").val(data.PartName);  
 $("#IDCust").val(data.IDCust); 
 $("#CustName").val(data.CustName2);   
 $("#IDProject").val(data.IDProject); 
 $("#Spec").val(data.SpecOrder); 
 $("#MaterialType").val(data.MaterialType);
 $("#MaterialTypeID").val(data.MaterialTypeID);
 $("#PcsPerSheet").val(data.PcsPerSheet);
 $("#KgPerSheet").val(data.KgPerSheet);
 $("#DocNumExt").val(data.DocNum_Ext);
 $("#QtyMat").val(data.Qty_1);
 $("#QtyPcs").val(data.Qty_2);
 $("#NGMat").val(data.Qty_5);
 $("#BalMatBe").val(data.Qty_3);
 $("#BalPcsBe").val(data.Qty_4);
 $("#BalMatSource").val(data.BalMatSource);
 $("#BalPcsSource").val(data.BalPcsSource);
}  });  };
                        
$("#DocNum2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#DocNumDetail2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#SJNum").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#MatNum").keyup(function(e){var isi = $(e.target).val();$(e.target).val(isi.toUpperCase());});
$("#PcsPerSheet").keypress(function(data){if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { 
return false; } });
$("#KgPerSheet").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
return false; } });
$("#QtyMat").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
return false; } });
        
function hitung(){
var QtyMat      = $("#QtyMat").val();
var QtyPcs     = $("#QtyPcs").val();
var BalMatSource      = $("#BalMatSource").val();
var BalPcsSource     = $("#BalPcsSource").val();
var NGMat     = $("#NGMat").val();
var NGMatBe     = $("#NGMatBe").val();
var BalMatSourceAf      = $("#BalMatSourceAf").val();
var BalPcsSourceAf     = $("#BalPcsSourceAf").val();
var BalMatBe      = $("#BalMatBe").val();
var BalPcsBe      = $("#BalPcsBe").val();
var BalMatAf      = $("#BalMatAf").val();
var BalPcsAf      = $("#BalPcsAf").val();
var PcsPerSheet = $("#PcsPerSheet").val();
var KgPerSheet    = $("#KgPerSheet").val();
var MaterialType         = $("#MaterialTypeID").val();
var BalMatSourceAf = (parseFloat(BalMatSource) +  parseFloat(BalMatBe)) - parseFloat(QtyMat);

$("#BalMatSourceAf").val(BalMatSourceAf);
var BalMatAf = (parseFloat(QtyMat) - parseFloat(NGMat)) + parseFloat(NGMatBe);
$("#BalMatAf").val(BalMatAf);                
if(MaterialType==2){ var BalPcsSourceAf = (parseFloat(BalPcsSource) + parseFloat(BalPcsBe)) - (parseFloat(QtyMat) * parseFloat(PcsPerSheet));
$("#BalPcsSourceAf").val(BalPcsSourceAf);  }                
if(MaterialType==1){
var BalPcsSourceAf = (parseFloat(BalPcsSource) + parseFloat(BalPcsBe)) - (parseFloat(QtyMat) / parseFloat(KgPerSheet));
$("#BalPcsSourceAf").val(BalPcsSourceAf); }
if(MaterialType==2){ var BalPcsAf = parseFloat(BalMatAf) * parseFloat(PcsPerSheet);
$("#BalPcsAf").val(BalPcsAf); }    
if(MaterialType==1){ var BalPcsAf = parseFloat(BalMatAf) / parseFloat(KgPerSheet);
$("#BalPcsAf").val(BalPcsAf);  }
if(MaterialType==2){ var QtyPcs = parseFloat(QtyMat) * parseFloat(PcsPerSheet);
$("#QtyPcs").val(QtyPcs); }    
if(MaterialType==1){ var QtyPcs = parseFloat(QtyMat) / parseFloat(KgPerSheet);
$("#QtyPcs").val(QtyPcs); } }
        
$("#QtyMat").keyup(function(){ hitung(); });
$("#PcsPerSheet").keyup(function(){ hitung(); });
$("#KgPerSheet").keyup(function(){ hitung(); });
$("#NGMat").keyup(function(){ hitung(); });
$("#NGMat").focusout(function(){ hitung(); });
$("#QtyMat").focusout(function(){ hitung(); });
$("#QtyMat").focus(function(){ hitung(); });
$("#PcsPerSheet").focus(function(){ hitung(); });
$("#KgPerSheet").focus(function(){ hitung(); });
$("#NGMat").focus(function(){ hitung(); });
$("#NGMat").focus(function(){ hitung(); });
$("#QtyMat").focus(function(){ hitung(); });
$("#DocNumDetail2").focus(function(){ hitung(); });
$("#DocNumDetail2").focusout(function(){ hitung(); });
$("#DocNumDetail2").click(function(){ hitung(); });
 
$("#form-tab").click(function(){
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function () {  AmbilForm(); tampil_data_detail();
setTimeout(function(){ $("#RefNum").focus(); $("#RefNum").click();
waitingDialog3.hide(); },300) ; ta}, 1000); });

$("#form-tab3").click(function(){
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function () { 
AmbilForm(); 
setTimeout(function(){
$("#Spec").focus();
$("#Spec").click();},300) ;
ta}, 1000); });
        
$("#Add_2").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    var DocNum = $("#DocNumView").val() ;
    $("#DocNum").val(DocNum) ;
    
    setTimeout(function () { 
        AmbilFormAdd(); 
        tampil_data_detail();
     setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
                    waitingDialog3.hide();
				},300) ;
      ta}, 1000);
    
    });
    
    
    $("#Home").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    $("#Home2").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    $("#Home3").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    

    $('#Add').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       AmbilForm(); $("#Spec").click(); $("#Spec").focus();
   }, 500);
});

    $('#Save').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 500);
});
    
function AmbilForm(){
 var kode = "";
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/Material_out/InfoTambahFormMatOut",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#DocNum").val(data.DocNum);
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#DocDate").val(data.DocDate);
 $("#CreateTime").val(data.CreateTime);
 $("#SJDate").val(data.CreateDate);
 $("#CanEdit").val("0");
 $("#DocNumDetail3").val(""); 
 $("#DocNumDetail2").val("");
 $("#ItemID").val("");
 $("#PartNo").val("");
 $("#PartName").val("");
 $("#IDCust").val("");
 $("#CustName").val("");
 $("#Spec").val("");
 $("#PcsPerDay").val("");
 $("#PcsPerSheet").val("");
 $("#KgPerSheet").val("");
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
 $("#BalPcsBe").val("0");
 $("#BalMatAf").val("0");
 $("#BalPcsAf").val("0");
 $("#NGMat").val("0");
 $("#ItemIDExt").val("");
 $("#MaterialType").val("");
 $("#MaterialTypeID").val("");                                                                       
 setTimeout(function(){
 tampil_data_detail();
 },300) ;
 }  });  };
                
function AmbilFormDetail(){
 var kode = $("#DocNum").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/Material_out/InfoTambahFormDetail",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#SJDate").val(data.CreateDate);
 $("#CanEdit").val("0");
 $("#DocNumDetail2").val("");
 $("#DocNumDetail3").val("");
 $("#QtyMatBefore").val("0"); 
 $("#ItemID").val("");
 $("#ItemID").val("");
 $("#PartNo").val("");
 $("#PartName").val("");
                $("#IDCust").val("");
                $("#CustName").val("");
                $("#Spec").val("");
                $("#PcsPerDay").val("");
                $("#PcsPerSheet").val("");
                $("#KgPerSheet").val("");
                $("#DocNumExt").val("");
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
                $("#BalPcsBe").val("0");
                $("#BalMatAf").val("0");
                $("#BalPcsAf").val("0");
                $("#NGMat").val("0");
                
                $("#ItemIDExt").val("");
                
                $("#MaterialType").val("");
                $("#MaterialTypeID").val("");            
			 }  });  };
                
function AmbilFormAdd(){
		var id = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_out/RegDocNumSony_Add",
			data	: "id="+id,
			cache	: false,
			dataType : "json",
			success	: function(data){
			 $("#DocNumDetail").val(data.DocNumDetail);
                $("#DocDate").val(data.DocDate); 
                $("#ShiftID").val(data.ShiftID);
                $("#Qty_2").val("4"); 
                }  });  };
    

tampil_data();
function tampil_data(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/transaction_list",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#transaction_list").html(data);

  
  	} }); };

function tampil_data_detail(){
var id = $("#DocNum").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/transaction_detail",
data	: "id="+id,
cache	: false,
success	: function(data){
$("#transaction_detail").html(data);
waitingDialog3.hide();	} }); };


$("#DocNum2").click(function(){
    tampil_data_detail_2();
    });
$("#DocNum2").keyup(function(){
    tampil_data_detail_2();
    });
$("#DocNum2").keydown(function(){
    tampil_data_detail_2();
    });
    $("#DocNum2").focus(function(){
    tampil_data_detail_2();
    });
function tampil_data_detail_2(){
var id = $("#DocNum2").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/transaction_detail_2",
data	: "id="+id,
cache	: false,
success	: function(data){
$("#transaction_detail_2").html(data);	} }); };


$("#DocNumSearch").keyup(function(event){
if(event.keyCode == 13){ $("#DocNumSearchButton").click(); } });

$("#DocNumExt").click(function(){ List_Material();  });	

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 List_Material(); });
 
function List_Material(){
 var kode = "" ;
 $("#List_Material").html("");
 $('#Reload2').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/List_Material",
data	: "kode="+kode,
cache	: false,
success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#List_Material").html(data); }, 700); } }); };


$('#reload').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
tampil_data();
}, 500); });

$('#reload1').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
tampil_data_detail_2();
}, 500); });

$('#AddDetail').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
AmbilFormDetail();
tampil_data_detail();
}, 300);
});

$('#AddDetail_2').on('click', function() {
var DocNum = $("#DocNum2").val() ; $("#DocNum").val(DocNum);
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
AmbilFormDetail();
tampil_data_detail();

}, 300);
});

function textAreaAdjust2() {
style.height = "5px";
style.height = (22+scrollHeight)+"px"; };

$("#Save").click(function(){
var DocNum = $("#DocNum").val();
var DocNumDetail = $("#DocNumDetail").val()
var BalMatSourceAf = $("#BalMatSourceAf").val();
var BalPcsSourceAf = $("#BalPcsSourceAf").val();
var BalMatBe = $("#BalMatBe").val();
var BalPcsBe = $("#BalPcsBe").val();
var BalMatAf = $("#BalMatAf").val();
var BalPcsAf = $("#BalPcsAf").val();
var MaterialType = $("#MaterialType").val(); 
var MaterialTypeID = $("#MaterialTypeID").val()
var CreateDate = $("#CreateDate").val(); 

var CreateTime = $("#CreateTime").val(); 
var DocDate = $("#DocDate").val(); 
var DocNumDetail3 = $("#DocNumDetail3").val(); 
var CanEdit = $("#CanEdit").val(); 
var NGMatBe = $("#NGMatBe").val(); 
var QtyPcs = $("#QtyPcs").val(); 
var DocNumExt = $("#DocNumExt").val(); 
var ItemIDExt = $("#ItemIDExt").val();
var ItemID = $("#ItemID").val();
var PcsPerSheet = $("#PcsPerSheet").val();
var KgPerSheet = $("#KgPerSheet").val();
var BalMatSource = $("#BalMatSource").val();
var BalPcsSource = $("#BalPcsSource").val();
var QtyMat = $("#QtyMat").val();
var NGMat = $("#NGMat").val();

if(DocNum.length==0){
NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); 
return false(); }

if(DocNumExt.length==0){ 
NotifFail('Ref No Harus di isi'); return false(); 	}

if(MaterialTypeID==2){
if(PcsPerSheet==0){
NotifFail('Pcs Per Sheet Harus di isi'); return false();}
if(PcsPerSheet.length==0){ 
NotifFail('Pcs Per Sheet Harus di isi');  
return false(); }   }

if(MaterialTypeID==1){
if(KgPerSheet==0){
NotifFail('Pcs Per Kg Harus di isi');  
return false();}
if(KgPerSheet.length==0){
NotifFail('Pcs Per Kg Harus di isi');  
return false(); } }

if(QtyMat<=0){
NotifFail('Qty tidak boleh kurang dari atau sama dengan nol ');  
return false(); }
if(NGMat<0){ NotifFail('Qty tidak boleh kurang dari');  
return false(); }

if(BalMatSourceAf<0){
NotifFail('Material tidak cukup !');  return false(); } 
        
if(isNaN(BalMatSourceAf)){
NotifFail('Isi sesuai perintah !'); 
return false(); }
        
if(CanEdit>0){
NotifFail('Dokumen ini tidak bisa diedit, sudah digunakan'); 
return false(); }

$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/Save",
data	: "&DocNum="+DocNum+"&DocNumDetail="+DocNumDetail+"&BalMatSourceAf="+BalMatSourceAf+"&BalPcsSourceAf="+BalPcsSourceAf+"&BalMatBe="+BalMatBe+"&BalPcsBe="+BalPcsBe+"&BalMatAf="+BalMatAf+"&BalPcsAf="+BalPcsAf+"&MaterialType="+MaterialType+"&MaterialTypeID="+MaterialTypeID+"&CreateDate="+CreateDate+"&DocDate="+DocDate+"&DocNumDetail3="+DocNumDetail3+"&CanEdit="+CanEdit+"&NGMatBe="+NGMatBe+"&QtyPcs="+QtyPcs+"&DocNumExt="+DocNumExt+"&ItemIDExt="+ItemIDExt+"&ItemID="+ItemID+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&BalMatSource="+BalMatSource+"&BalPcsSource="+BalPcsSource+"&QtyMat="+QtyMat+"&NGMat="+NGMat+"&CreateTime="+CreateTime,
cache	: false,
success	: function(data){
setTimeout(function(){
tampil_data_detail(); AmbilFormDetail();
NotifSuccsess(data); },1000) },
                
error : function(xhr, teksStatus, kesalahan) {
NotifFail('Server tidak merespon :'+kesalahan);
} }); return false();	 });

function NotifSuccsess(data){
 new PNotify({
 title: 'Info',
 type: 'info',
 text: data,
 hide: true }); };
function NotifFail(data){
 new PNotify({
 title: 'Info',
 type: 'error',
 text: data,
 hide: true }); }; 
function NotifProses(data){
 new PNotify({
 title: 'Info',
 type: 'dark',
 text: data,
 hide: true }); };
      
      
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
			url		: "<?php echo site_url(); ?>/Material_out/InfoDataEdit",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#ItemIDExt").val(data.ItemID);
                $("#ItemID").val(data.ItemID);
                $("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#CustName").val(data.CustName2)
                $("#Spec").val(data.SpecOrder);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#KgPerSheet").val(data.KgPerSheet);
                $("#BalMatSource").val(data.Qty_3);
                $("#BalPcsSource").val(data.Qty_4);
                $("#MaterialTypeID").val(data.MaterialTypeID);
                $("#MaterialType").val(data.MaterialType);
                                
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#BalMatAf").val("0");
                $("#BalPcsAf").val("0");
                $("#NGMat").val("0");
                
                $("#QtyMat").val(data.Qty_3);
                $("#QtyPcs").val(data.Qty_4);
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#DocNumDetail2").val("");
                $("#DocNumDetail3").val("");
                
                setTimeout(function(){
                hitung(); 
                },500)
                
			 }  });  };
             
             
             
$("#HapusDetail").click(function(){
    var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
    var CanEditDelete         = $("#CanEditDelete").val();
    var QtyMatDelete         = $("#QtyMatDelete").val();
    var QtyPcsDelete         = $("#QtyPcsDelete").val();
    var DocNum_ExtDelete         = $("#DocNum_ExtDelete").val();
    
if(CanEditDelete>0){
NotifFail('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
$("#myModalDelete").modal('hide');  
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/Hapus_Detail",
data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&CanEditDelete="+CanEditDelete+"&QtyMatDelete="+QtyMatDelete+"&QtyPcsDelete="+QtyPcsDelete+"&DocNum_ExtDelete="+DocNum_ExtDelete,
cache	: false,
success	: function(data){
setTimeout(function(){
NotifSuccsess(data); 
$("#DocNum2").click(); $("#DocNum2").focus();
AmbilFormDetail(); tampil_data_detail() ; },300) },
error : function(xhr, teksStatus, kesalahan) {
$("#myModal4").modal('show');
$("#pesan4").text('Server tidak merespon :'+kesalahan); } 	}); return false();	 });
    
 $("#HapusDetail2").click(function(){
		var DocNumDetailDelete	    = $("#DocNumDetailDelete2").val();

        $("#myModalDelete2").modal('hide');  
		
	
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_out/Hapus_Detail",
			data	: "DocNumDetailDelete="+DocNumDetailDelete,
			cache	: false,
			success	: function(data){
            setTimeout(function(){
            NotifSuccsess(data); 
             $("#DocNumView").click(); $("#DocNumView").focus(); 
             tampil_data_detail_2() ;
            },300)
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
    
$("#DocNumDetail2Search").focus(function(e){
	var isi = $(e.target).val();
	AmbilFormSearch();
	});
    $("#DocNumDetail2Search").click(function(e){
    var isi = $(e.target).val();
	AmbilFormSearch();
	 });
     
    function AmbilFormSearch(){
        var x = $("#DocNumDetail2Search").val();
        var y = "BSTM" ;
        
        if(x.match(y)){
        var kode = $("#DocNumDetail2Search").val();
        }else{
        var kode = "" ;    
        }
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_out/InfoDataEdit",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
 
                 $("#CreateBy").val(data.CreateBy);
                $("#CreateDateSearch").val(data.CreateDate);
                $("#CreateTimeSearch").val(data.CreateTime);
                $("#DocDateSearch").val(data.DocDate);
                
                $("#DocNum2Search").val(data.DocNum); 
                $("#DocNumDetailSearch").val(data.DocNumDetailOut);
                $("#DocNumDetail3Search").val(data.DocNumDetail3); 
                $("#ItemIDSearch").val(data.ItemID);
                $("#ItemIDExtSearch").val(data.ItemID_Ext);
                $("#CanEditSearch").val(data.CanEdit);  
                
                $("#PartNoSearch").val(data.PartNo); 
                $("#PartNameSearch").val(data.PartName);  
                $("#IDCustSearch").val(data.IDCust); 
                $("#CustNameSearch").val(data.CustName2);   
                $("#IDProjectSearch").val(data.IDProject); 
                $("#SpecSearch").val(data.SpecOrder);
                
                
                $("#MaterialTypeSearch").val(data.MaterialTypeID);
                $("#MaterialNameSearch").val(data.MaterialType);
                
                $("#PcsPerSheetSearch").val(data.PcsPerSheet);
                $("#PcsPerKgSearch").val(data.KgPerSheet);
                                
                $("#DocNumExtSearch").val(data.DocNum_Ext);
                
                $("#QtyMatSearch").val(data.Qty_1);
                $("#QtyPcsSearch").val(data.Qty_2);
                
                $("#NGMatSearch").val(data.Qty_5);
                
                $("#BalMatBeSearch").val(data.Qty_1);
                $("#BalPcsBeSearch").val(data.Qty_2);
                
                $("#BalMatSourceSearch").val(data.BalMatSource);
                $("#BalPcsSourceSearch").val(data.BalPcsSource);
                
                waitingDialog3.hide();
                         
			 }  });  };
             
        $("#Search").click(function(){
		var IDCust2 = $("#IDCust2").val();
		var PartNo3 = $("#PartNo3").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = "&IDCust2="+IDCust2+"&DocDateReport_1="+DocDateReport_1+"&DocDateReport_2="+DocDateReport_2+"&PartNo3="+PartNo3;
		
		if(DocDateReport_1.length==0){
           $("#myModal4").modal('show');
           $("#pesan4").text('Tanggal tidak boleh kosong');
		   return false();
         }
		 if(DocDateReport_2.length==0){
           $("#myModal4").modal('show');
           $("#pesan4").text('Tanggal tidak boleh kosong');
		   return false();
         }
   
         var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
		 $("#detail_report").html('');
		 $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_out/ReadReport",
			data	: string,
			cache	: false,
			success	: function(data){
			setTimeout(function(){
			waitingDialog3.hide();
			$("#transaction_detail_report").html(data); },1000) } }); return false();	 });
            
            
   $("#cetak").click(function(){
        var IDCust2 = $("#IDCust2").val();
		var PartNo3= $("#PartNo3").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
		var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust2+"/"+PartNo3;
        
		if(DocDateReport_1.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false(); }
		 if(DocDateReport_2.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();} 
           
        window.open('<?php echo site_url();?>/Material_out/ExportReport/'+string); return false();	 });
    
    
    $("#Print4").click(function(){
        var IDCust2 = $("#IDCust2").val();
		var PartNo3= $("#PartNo3").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust2+"/"+PartNo3;
		
		if(DocDateReport_1.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();
         }
		 if(DocDateReport_2.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();
         } 
         
		window.open('<?php echo site_url();?>/Material_out/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
        
    

$("#Print").click(function(){
var kode	= $("#DocNum").val();
window.open('<?php echo site_url();?>/Material_out/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
return false();
});

$("#Print2").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/Material_out/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
    $("#Print3").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/Material_out/PrintList/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
            
function MasterList(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_out/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };
    
         
$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#DocNumExt").click(function(){
var DocNumDetail3 = $("#DocNumDetail3").val();
if(DocNumDetail3.length==0){
$("#myModal_MaterialList").modal('show'); $("#Reload2").click();
return false(); } });
        
    
});	
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>

<a href="#tab_content4" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa fa-folder-open"></i>&nbsp; Report</a>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

<div class="col-xs-3 pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNumSearch" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
<a  onclick="Search()" href="#" >
<button class="btn btn-default" id="DocNumSearchButton" type="button">Go!</button></a>
</span>
</div></div>

</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<?php $cek = $this->Role_Model->TrcMaterialView(); if(!empty($cek)){ ?>
<div id="transaction_list"></div>
<?php } ?>
</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal" id="form_id" name="form_id">
<div hidden="">
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div>
<div class="panel-body">
<div class="col-md-6">        
<div class="form-group">
<label class="col-lg-4 control-label">DocNum</label>
<div class="col-lg-5">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-3">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Balance Material</label>
<div class="col-lg-4">
<input type="text" id="BalMatSourceAf" name="BalMatSourceAf"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsSourceAf" name="BalPcsSourceAf"  class="form-control" readonly="true" value="0">
</div> </div>
<div class="form-group">
<label class="col-lg-4 control-label">Balance Before</label>
<div class="col-lg-4">
<input type="text" id="BalMatBe" name="BalMatBe"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsBe" name="BalPcsBe"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Balance After</label>
<div class="col-lg-4">
<input type="text" id="BalMatAf" name="BalMatAf"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsAf" name="BalPcsAf"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Material Type</label>
<div class="col-lg-4">
<input type="text" id="MaterialTypeID" name="MaterialTypeID"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="MaterialType" name="MaterialType"  class="form-control" readonly="readonly">
</div> </div> 
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">CreateDate</label>
<div class="col-lg-8">
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">DocTime</label>
<div class="col-lg-8">
<input type="text" id="CreateTime" name="CreateTime"  class="form-control" readonly="readonly">
</div></div> 

<div class="form-group">
<label class="col-lg-4 control-label">DocNumDetail</label>
<div class="col-lg-4">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="CanEdit" name="CanEdit"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">NG Before</label>
<div class="col-lg-8">
<input type="text" id="NGMatBe" name="NGMatBe"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Qty Pcs</label>
<div class="col-lg-8">
<input type="text" id="QtyPcs" name="QtyPcs"  class="form-control" readonly="true" value="0">
</div> </div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Form &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
<div id="product" class="collapse in">
<div class="panel-body">


<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">DocDate</label>
<div class="col-lg-8">
<input type="text" id="DocDate" name="DocDate" value="<?php echo $DocDateReport_2 ; ?>"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Ref. No</label>
<div class="col-lg-8">
<input type="text" id="DocNumExt" name="DocNumExt"  class="form-control" readonly="true">
</div>
<input type="text" id="ItemIDExt" name="ItemIDExt" hidden="" readonly="true">
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<input type="text" id="ItemID" name="ItemID" hidden="" readonly="readonly">
<div class="col-lg-8">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">ID Customer</label>
<div class="col-lg-8">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly">
</div> </div> 
</div> 

<div class="col-md-6">
    <div class="form-group">
<label class="col-lg-4 control-label">PCS/sheet</label>
<div class="col-lg-4">
<input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control">
</div>
<div class="col-lg-4">
<input type="text" id="KgPerSheet" name="KgPerSheet"  class="form-control">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Spec</label>
<div class="col-lg-8">
<input type="text" id="Spec" name="Spec"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Stock</label>
<div class="col-lg-4">
<input type="text" id="BalMatSource" name="BalMatSource"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsSource" name="BalPcsSource"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Qty Material</label>
<div class="col-lg-4">
<input type="text" id="QtyMat" name="QtyMat"  class="form-control" value="0" placeholder="Harus di isi">
</div>
<div class="col-lg-4">
<input type="text" id="NGMat" name="NGMat"  class="form-control" value="0" placeholder="NG">
</div></div>
</div>


</div></div></div></div>


</form>


<div class="box-body panel-footer">

<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
<button type="button" id="Save" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-save"></i>&nbsp; Save</button>
<button type="button" id="AddDetail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="Print" id="Print" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
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

<div id="transaction_detail"></div>

</div></div></div>

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">


<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="AddDetail_2" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa fa-plus"></i>&nbsp; Add</a> <?php } ?>
<button type="button" name="Print2" id="Print2" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp; Label</button>
<button type="button" name="Print3" id="Print3" class="btn btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
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

<div id="transaction_detail_2"></div>

</div></div>`

</div>

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

</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust2" name="IDCust2" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="semua">All</option>
<?php } foreach($l_cust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } } ?>  
</select>
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-8">
<input type="text" id="PartNo3" name="PartNo3"  class="form-control" >
</div></div>

</div></div>
</div></div></div>

</form>


</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
<button type="button" name="cetak" id="cetak" class="btn btn-info"><i class="glyphicon glyphicon-import"></i> Download</button>
<button type="button" name="Print4" id="Print4" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Print</button>
         
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-primary">
<i class="fa fa-reply"></i> Closed</a>
<?php $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>

</div></div></div></div></div>
</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="transaction_detail_report"></div>

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
    <input hidden="true" type="text" id="QtyMatDelete" name="QtyMatDelete" readonly="true" >
    <input hidden="true" type="text" id="QtyPcsDelete" name="QtyPcsDelete" readonly="true" >
    <input hidden="true" type="text" id="DocNum_ExtDelete" name="DocNum_ExtDelete" readonly="true" >
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
                        
<div id="pesan2"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete2"></div>
<br /><br /><br />
<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<button type="button" name="HapusDetail2" id="HapusDetail2" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
    
<form class="navbar-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetailDelete2" name="DocNumDetailDelete2" class="form-control" readonly="true" ></div>
</form></div>
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModal_MaterialList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="List_Material"></div>
</div> </div> </div> </div> </div> </div> </div>


<div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Detail Transaction</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">


<form class="form-horizontal"  name="formSearch" id="formSearch">
<div hidden="">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksiSearch"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksiSearch" class="collapse">
<div class="panel-body">
   
<div class="col-md-6">        
<div class="form-group">
<label class="col-lg-4 control-label">DocNum</label>
<div class="col-lg-5">
<input type="text" id="DocNum2Search" name="DocNum2Search"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-3">
<input type="text" id="DocNumDetailSearch" name="DocNumDetailSearch"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Balance Material</label>
<div class="col-lg-4">
<input type="text" id="BalMatSourceAfSearch" name="BalMatSourceAfSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsSourceAfSearch" name="BalPcsSourceAfSearch"  class="form-control" readonly="true" value="0">
</div> </div>
<div class="form-group">
<label class="col-lg-4 control-label">Balance Before</label>
<div class="col-lg-4">
<input type="text" id="BalMatBeSearch" name="BalMatBeSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsBeSearch" name="BalPcsBeSearch"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Balance After</label>
<div class="col-lg-4">
<input type="text" id="BalMatAfSearch" name="BalMatAfSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsAfSearch" name="BalPcsAfSearch"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Material Type</label>
<div class="col-lg-4">
<input type="text" id="MaterialTypeSearch" name="MaterialTypeSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="MaterialNameSearch" name="MaterialNameSearch"  class="form-control" readonly="readonly">
</div> </div> 
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">CreateDate</label>
<div class="col-lg-8">
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">DocTime</label>
<div class="col-lg-8">
<input type="text" id="CreateTimeSearch" name="CreateTimeSearch"  class="form-control" readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-lg-4 control-label">DocDate</label>
<div class="col-lg-8">
<input type="text" id="DocDateSearch" name="DocDateSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">DocNumDetail</label>
<div class="col-lg-4">
<input type="text" id="DocNumDetail3Search" name="DocNumDetail3Search"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="CanEditSearch" name="CanEditSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">NG Before</label>
<div class="col-lg-8">
<input type="text" id="NGMatBeSearch" name="NGMatBeSearch"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Qty Pcs</label>
<div class="col-lg-8">
<input type="text" id="QtyPcsSearch" name="QtyPcsSearch"  class="form-control" readonly="true" value="0">
</div> </div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#productSearch"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
<div id="productSearch" class="collapse in">
<div class="panel-body">


<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Created By</label>
<div class="col-lg-8">
<input type="text" id="CreateBy" name="CreateBy"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Ref. No</label>
<div class="col-lg-5">
<input type="text" id="DocNumExtSearch" name="DocNumExtSearch"  class="form-control" readonly="true">
</div>
<div class="col-lg-3">
<input type="text" id="ItemIDExtSearch" name="ItemIDExtSearch"  class="form-control" readonly="true">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-2">
<input type="text" id="ItemIDSearch" name="ItemIDSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-6">
<input type="text" id="PartNoSearch" name="PartNoSearch"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartNameSearch" name="PartNameSearch"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">ID Customer</label>
<div class="col-lg-8">
<input type="text" id="CustNameSearch" name="CustNameSearch"  class="form-control" readonly="readonly">
</div> </div> 
</div> 

<div class="col-md-6">
    <div class="form-group">
<label class="col-lg-4 control-label">PCS/sheet</label>
<div class="col-lg-4">
<input type="text" id="PcsPerSheetSearch" name="PcsPerSheetSearch"  class="form-control" readonly="true">
</div>
<div class="col-lg-4">
<input type="text" id="PcsPerKgSearch" name="PcsPerKgSearch"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Spec</label>
<div class="col-lg-8">
<input type="text" id="SpecSearch" name="SpecSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Stock</label>
<div class="col-lg-4">
<input type="text" id="BalMatSourceSearch" name="BalMatSourceSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsSourceSearch" name="BalPcsSourceSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Qty Material</label>
<div class="col-lg-4">
<input type="text" id="QtyMatSearch" name="QtyMatSearch"  class="form-control" value="0" placeholder="Harus di isi" readonly="true">
</div>
<div class="col-lg-4">
<input type="text" id="NGMatSearch" name="NGMatSearch"  class="form-control" value="0" placeholder="NG" readonly="true">
</div></div>
</div>


</div></div></div></div></form>

    <div class="panel-footer">
    <?php $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
    <a  onclick="PilihEditSearch()" href="#tab_content2" data-toggle="tab" aria-expanded="false"  class="btn btn-warning">
    <i class="glyphicon glyphicon-edit"></i> Edit</a>
    <?php } ?>  
    <form class="navbar-right" role="search">
    <div class="form-group">
    <input type="text" id="DocNumDetail2Search" name="DocNumDetail2Search" class="form-control" placeholder="Search"></div>
    </form>
          
    </div>
    
    

 </div> </div> </div> </div> </div> </div> </div> 
 
     <script type="text/javascript">

function pilih2(id){
	$("#myModal_MaterialList").modal("hide");
	$("#DocNumExt").val(id);
	$("#DocNumExt").focus();
	
}
</script>

<script type="text/javascript"> 
function PilihEdit(id){
	$("#DocNumDetail2").val(id);
    $("#DocNumDetail").val(id.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,Qty_1,Qty_2,Qty_5,BalMat,BalPcs,CanEditDelete,DocNum_Ext){
var BalMatSource = parseFloat(Qty_1) + parseFloat(BalMat) + parseFloat(Qty_5) ;
var BalPcsSource = parseFloat(Qty_2) + parseFloat(BalPcs) + parseFloat(Qty_5) ;
$("#myModalDelete").modal('show');
$("#DocNumDetailDelete").val(DocNumDetail);
$("#CanEditDelete").val(CanEditDelete);
$("#QtyMatDelete").val(BalMatSource);
$("#QtyPcsDelete").val(BalPcsSource);
$("#DocNum_ExtDelete").val(DocNum_Ext);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>

    <script type="text/javascript">     
function Search(){
    var DocNumSearch 	    = $("#DocNumSearch").val();
    if(DocNumSearch.length==0){
      $("#myModal4").modal('show');
      $("#pesan4").text('Masukan No Barcode');  
    }else{
    $("#myModal_Search").modal("show");
	$("#DocNumDetail2Search").val(DocNumSearch);
    $("#DocNumDetailSearch").val(DocNumSearch.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2Search").focus();
					$("#DocNumDetail2Search").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2Search").focus();
					$("#DocNumDetail2Search").click();
				},300) ;
				},500) 
			return false(); 
	 }
    }
</script>
    <script type="text/javascript">     
function PilihEditSearch(){
    var DocNumDetail2Search 	    = $("#DocNumDetail2Search").val();
    $("#myModal_Search").modal("hide");
	$("#DocNumDetail2").val(DocNumDetail2Search);
    $("#DocNumDetail").val(DocNumDetail2Search.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>

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
  });
</script> 

<script> $(function () { $("#t_list_master").DataTable(); });</script>