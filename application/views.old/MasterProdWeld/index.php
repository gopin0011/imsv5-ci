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
url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct",
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
 var CP1	    = $("#CP1").val();
 var string = $("#form").serialize();
 if(PartNo.length==0){ NotifFail('Part No Harus di isi');  return false(); } 
 if(PartName.length==0){ NotifFail('Part Name Harus di isi');  return false(); } 
 if(IDCust.length==0){ NotifFail('Customer Harus di isi'); return false(); }
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterProdWeld/Save",
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
                $("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#CustName").val(data.CustName);
                $("#IDProject").val(data.IDProject);
                $("#Spec1").val(data.Spec1);
                $("#Spec2").val(data.Spec2);
                $("#PcsPerday").val(data.PcsPerday);
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
                
                $("#CP1").val(data.CP1);
                $("#CP2").val(data.CP2);
                $("#CP3").val(data.CP3);
                $("#CP4").val(data.CP4);
                $("#CP5").val(data.CP5);
                $("#CP6").val(data.CP6);
                $("#CP7").val(data.CP7);
                $("#CP8").val(data.CP8);
                $("#CP9").val(data.CP9);
                $("#CP10").val(data.CP10);
                $("#CP11").val(data.CP11);
                $("#CP12").val(data.CP12);
               CariCP1(); CariCP2(); CariCP3(); CariCP4(); CariCP5(); CariCP6();
               CariCP7(); CariCP8(); CariCP9(); CariCP10(); CariCP11(); CariCP12();
               
			 }  });  };
             
$("#CP1").focus(function(e){
 var isi = $(e.target).val();
 CariCP1(); });
 $("#CP1").keyup(function(){ CariCP1();	 });
function CariCP1(){
 var kode = $("#CP1").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#Part1").val(data.PartNo); }  });  };
    
$("#CP2").focus(function(e){
 var isi = $(e.target).val();
 CariCP2(); });
$("#CP2").keyup(function(){
CariCP2(); });
function CariCP2(){
 var kode = $("#CP2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
dataType : "json",
 success	: function(data){
 $("#Part2").val(data.PartNo); }  });  };
 
   $("#CP3").focus(function(e){
		var isi = $(e.target).val();
        CariCP3();
	});
	$("#CP3").keyup(function(){
        CariCP3();	
	});
    	function CariCP3(){
		var kode = $("#CP3").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part3").val(data.PartNo);
			 }  });  };
             
      $("#CP4").focus(function(e){
		var isi = $(e.target).val();
        CariCP4();
	});
	$("#CP4").keyup(function(){
        CariCP4();	
	});
    	function CariCP4(){
		var kode = $("#CP4").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part4").val(data.PartNo);
			 }  });  };
 
    $("#CP5").focus(function(e){
		var isi = $(e.target).val();
        CariCP5();
	});
	$("#CP5").keyup(function(){
        CariCP5();	
	});
    	function CariCP5(){
		var kode = $("#CP5").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part5").val(data.PartNo);
			 }  });  };
             
      $("#CP6").focus(function(e){
		var isi = $(e.target).val();
        CariCP6();
	});
	$("#CP6").keyup(function(){
        CariCP6();	
	});
    	function CariCP6(){
		var kode = $("#CP6").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part6").val(data.PartNo);
			 }  });  };
     $("#CP7").focus(function(e){
		var isi = $(e.target).val();
        CariCP7();
	});
	$("#CP7").keyup(function(){
        CariCP7();	
	});
    	function CariCP7(){
		var kode = $("#CP7").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part7").val(data.PartNo);
			 }  });  };
             
      $("#CP8").focus(function(e){
		var isi = $(e.target).val();
        CariCP8();
	});
	$("#CP8").keyup(function(){
        CariCP8();	
	});
    	function CariCP8(){
		var kode = $("#CP8").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part8").val(data.PartNo);
			 }  });  };
             
     $("#CP9").focus(function(e){
		var isi = $(e.target).val();
        CariCP9();
	});
	$("#CP9").keyup(function(){
        CariCP9();	
	});
    	function CariCP9(){
		var kode = $("#CP9").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part9").val(data.PartNo);
			 }  });  };
             
       $("#CP10").focus(function(e){
		var isi = $(e.target).val();
        CariCP10();
	});
	$("#CP10").keyup(function(){
        CariCP10();	
	});
    	function CariCP10(){
		var kode = $("#CP10").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part10").val(data.PartNo);
			 }  });  };
             
      $("#CP11").focus(function(e){
		var isi = $(e.target).val();
        CariCP11();
	});
	$("#CP11").keyup(function(){
        CariCP11();	
	});
    	function CariCP11(){
		var kode = $("#CP11").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part11").val(data.PartNo);
			 }  });  };
  
     $("#CP12").focus(function(e){
		var isi = $(e.target).val();
        CariCP12();
	});
	$("#CP12").keyup(function(){
        CariCP12();	
	});
    	function CariCP12(){
		var kode = $("#CP12").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#Part12").val(data.PartNo);
			 }  });  };
             

             
$("#Hapus").click(function(){
 var ItemID	    = $("#ItemID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/Hapus_Product",
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
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct1",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP1').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };
 
 $('#ReloadCP2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList2(); });
      
function MasterList2(){
 var kode = "" ;
 $("#MasterList2").html("");
 $('#ReloadCP2').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP2').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList2").html(data); }, 700); } }); };
 
  $('#ReloadCP3').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList3(); });
      
function MasterList3(){
 var kode = "" ;
 $("#MasterList3").html("");
 $('#ReloadCP3').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct3",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP3').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList3").html(data); }, 700); } }); };
 
   $('#ReloadCP4').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList4(); });
      
function MasterList4(){
 var kode = "" ;
 $("#MasterList4").html("");
 $('#ReloadCP4').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct4",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP4').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList4").html(data); }, 700); } }); };
 
   $('#ReloadCP5').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList5(); });
      
function MasterList5(){
 var kode = "" ;
 $("#MasterList5").html("");
 $('#ReloadCP5').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct5",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP5').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList5").html(data); }, 700); } }); };
 
   $('#ReloadCP6').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList6(); });
      
function MasterList6(){
 var kode = "" ;
 $("#MasterList6").html("");
 $('#ReloadCP6').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct6",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP6').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList6").html(data); }, 700); } }); };
 
   $('#ReloadCP7').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList7(); });
      
function MasterList7(){
 var kode = "" ;
 $("#MasterList7").html("");
 $('#ReloadCP7').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct7",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP7').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList7").html(data); }, 700); } }); };
 
$('#ReloadCP7').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList7(); });
      
function MasterList7(){
 var kode = "" ;
 $("#MasterList7").html("");
 $('#ReloadCP7').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct7",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP7').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList7").html(data); }, 700); } }); };
 
   $('#ReloadCP8').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList8(); });
      
function MasterList8(){
 var kode = "" ;
 $("#MasterList8").html("");
 $('#ReloadCP8').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct8",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP8').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList8").html(data); }, 700); } }); };
 
    $('#ReloadCP9').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList9(); });
      
function MasterList9(){
 var kode = "" ;
 $("#MasterList9").html("");
 $('#ReloadCP9').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct9",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP9').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList9").html(data); }, 700); } }); };

    $('#ReloadCP10').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList10(); });
      
function MasterList10(){
 var kode = "" ;
 $("#MasterList10").html("");
 $('#ReloadCP10').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct10",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP10').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList10").html(data); }, 700); } }); };
 
    $('#ReloadCP11').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList11(); });
      
function MasterList11(){
 var kode = "" ;
 $("#MasterList11").html("");
 $('#ReloadCP11').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct11",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP11').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList11").html(data); }, 700); } }); };
 
    $('#ReloadCP12').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList12(); });
      
function MasterList12(){
 var kode = "" ;
 $("#MasterList12").html("");
 $('#ReloadCP12').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterProdWeld/ListProduct12",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadCP12').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList12").html(data); }, 700); } }); };
  
$("#CP1").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#Part1").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#CP2").click(function(){ $("#myModal_product2").modal('show'); MasterList2(); });
$("#Part2").click(function(){ $("#myModal_product2").modal('show'); MasterList2(); });
$("#CP3").click(function(){ $("#myModal_product3").modal('show'); MasterList3(); });
$("#Part3").click(function(){ $("#myModal_product3").modal('show'); MasterList3(); });
$("#CP4").click(function(){ $("#myModal_product4").modal('show'); MasterList4(); });
$("#Part4").click(function(){ $("#myModal_product4").modal('show'); MasterList4(); });
$("#CP5").click(function(){ $("#myModal_product5").modal('show'); MasterList5(); });
$("#Part5").click(function(){ $("#myModal_product5").modal('show'); MasterList5(); });
$("#CP6").click(function(){ $("#myModal_product6").modal('show'); MasterList6(); });
$("#Part6").click(function(){ $("#myModal_product6").modal('show'); MasterList6(); });
$("#CP7").click(function(){ $("#myModal_product7").modal('show'); MasterList7(); });
$("#Part7").click(function(){ $("#myModal_product7").modal('show'); MasterList7(); });
$("#CP8").click(function(){ $("#myModal_product8").modal('show'); MasterList8(); });
$("#Part8").click(function(){ $("#myModal_product8").modal('show'); MasterList8(); });
$("#CP9").click(function(){ $("#myModal_product9").modal('show'); MasterList9(); });
$("#Part9").click(function(){ $("#myModal_product9").modal('show'); MasterList9(); });
$("#CP10").click(function(){ $("#myModal_product10").modal('show'); MasterList10(); });
$("#Part10").click(function(){ $("#myModal_product10").modal('show'); MasterList10(); });
$("#CP11").click(function(){ $("#myModal_product11").modal('show'); MasterList11(); });
$("#Part11").click(function(){ $("#myModal_product11").modal('show'); MasterList11(); });
$("#CP12").click(function(){ $("#myModal_product12").modal('show'); MasterList12(); });
$("#Part12").click(function(){ $("#myModal_product12").modal('show'); MasterList12(); });

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
<input type="text" id="PcsPerday" name="PcsPerday"  class="form-control" value="0" placeholder="Kebutuhan Per Hari">
</div>
</div> 


</div>
<div class="col-md-6">
  
  <div class="form-group">
<label class="col-xs-4 control-label">Price</label>
<div class="col-xs-8">
<input type="text" id="Price" name="Price" class="form-control" value="0" placeholder="Harga Material">
</div>
</div> 

 <div class="form-group">
<label class="col-xs-4 control-label">Stock Min-Max</label>
<div class="col-xs-4">
<input type="text" id="Min" name="Min"  class="form-control" value="0" placeholder="Min">
</div>
<div class="col-xs-4">
<input type="text" id="Max" name="Max"  class="form-control" value="0" placeholder="Max">
</div>
</div>   

 <div class="form-group">
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="StockWip" name="StockWip" value="0" class="form-control" placeholder="Stock WIP">
</div> 
<div class="col-xs-4">
<input type="text" id="StockFG" name="StockFG" value="0" class="form-control" placeholder="Stock Finish Good">
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

</div>
</div>
<hr />
<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Child Part 1</label>
<div class="col-xs-4">
<input type="text" id="CP1" name="CP1"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part1" name="Part1"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 2</label>
<div class="col-xs-4">
<input type="text" id="CP2" name="CP2"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part2" name="Part2"  class="form-control" readonly="true">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 3</label>
<div class="col-xs-4">
<input type="text" id="CP3" name="CP3"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part3" name="Part3"  class="form-control" readonly="true">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 4</label>
<div class="col-xs-4">
<input type="text" id="CP4" name="CP4"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part4" name="Part4"  class="form-control" readonly="true">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 5</label>
<div class="col-xs-4">
<input type="text" id="CP5" name="CP5"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part5" name="Part5"  class="form-control" readonly="true">
</div>
</div> 
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 6</label>
<div class="col-xs-4">
<input type="text" id="CP6" name="CP6"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part6" name="Part6"  class="form-control" readonly="true">
</div>
</div> 
</div>
<div class="col-md-6">
 

 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 7</label>
<div class="col-xs-4">
<input type="text" id="CP7" name="CP7"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part7" name="Part7"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 8</label>
<div class="col-xs-4">
<input type="text" id="CP8" name="CP8"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part8" name="Part8"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 9</label>
<div class="col-xs-4">
<input type="text" id="CP9" name="CP9"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part9" name="Part9"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 10</label>
<div class="col-xs-4">
<input type="text" id="CP10" name="CP10"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part10" name="Part10"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 11</label>
<div class="col-xs-4">
<input type="text" id="CP11" name="CP11"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part11" name="Part11"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Child Part 12</label>
<div class="col-xs-4">
<input type="text" id="CP12" name="CP12"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Part12" name="Part12"  class="form-control" readonly="true">
</div> </div>
</div>
</div>
</form>

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

 <div class="modal fade" id="myModal_product2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP2" name="ReloadCP2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList2"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP3" name="ReloadCP3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList3"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP4" name="ReloadCP4" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList4"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP5" name="ReloadCP5" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList5"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP6" name="ReloadCP6" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList6"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP7" name="ReloadCP7" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList7"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP8" name="ReloadCP8" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList8"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP9" name="ReloadCP9" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList9"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP10" name="ReloadCP10" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList10"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP11" name="ReloadCP11" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList11"></div>
</div> </div> </div> </div> </div> </div> </div>

 <div class="modal fade" id="myModal_product12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadCP12" name="ReloadCP12" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList12"></div>
</div> </div> </div> </div> </div> </div> </div>
 
<script type="text/javascript"> 
function pilih(id){
 $("#myModal_product").modal('hide');
 $("#CP1").val(id);
 $("#CP1").focus(); }
</script>
<script type="text/javascript"> 
function pilih2(id){
 $("#myModal_product2").modal('hide');
 $("#CP2").val(id);
 $("#CP2").focus(); }
</script>
<script type="text/javascript"> 
function pilih3(id){
 $("#myModal_product3").modal('hide');
 $("#CP3").val(id);
 $("#CP3").focus(); }
</script>
<script type="text/javascript"> 
function pilih4(id){
 $("#myModal_product4").modal('hide');
 $("#CP4").val(id);
 $("#CP4").focus(); }
</script>
<script type="text/javascript"> 
function pilih5(id){
 $("#myModal_product5").modal('hide');
 $("#CP5").val(id);
 $("#CP5").focus(); }
</script>
<script type="text/javascript"> 
function pilih6(id){
 $("#myModal_product6").modal('hide');
 $("#CP6").val(id);
 $("#CP6").focus(); }
</script>
<script type="text/javascript"> 
function pilih7(id){
 $("#myModal_product7").modal('hide');
 $("#CP7").val(id);
 $("#CP7").focus(); }
</script>
<script type="text/javascript"> 
function pilih8(id){
 $("#myModal_product8").modal('hide');
 $("#CP8").val(id);
 $("#CP8").focus(); }
</script>
<script type="text/javascript"> 
function pilih9(id){
 $("#myModal_product9").modal('hide');
 $("#CP9").val(id);
 $("#CP9").focus(); }
</script>
<script type="text/javascript"> 
function pilih10(id){
 $("#myModal_product10").modal('hide');
 $("#CP10").val(id);
 $("#CP10").focus(); }
</script>
<script type="text/javascript"> 
function pilih11(id){
 $("#myModal_product11").modal('hide');
 $("#CP11").val(id);
 $("#CP11").focus(); }
</script>
<script type="text/javascript"> 
function pilih12(id){
 $("#myModal_product12").modal('hide');
 $("#CP12").val(id);
 $("#CP12").focus(); }
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