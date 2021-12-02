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

$('#Reload1').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       Detail_data();
       Detail_data2();
   }, 500);
});

$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });
    
function tampil_data(){
 var kode = "" ;
 $('#reload').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/TransactionList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#tampil_data").html(data);  $('#reload').button('reset');
 $("#myModal100").modal('hide'); 
 } }); };

$("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){
 $("#DocNumSearchButton").click();
 } });
 
$('#DetailTransaction').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 AmbilFormSearch(); });

function AmbilFormSearch(){
 var x = $("#DocNumDetail2Search").val();
 var y = "STP" ;
 if(x.match(y)){
 var kode = $("#DocNumDetail2Search").val();
 }else{
 var kode = "" ;   }
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoDataEditProd",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 setTimeout(function() {
 $('#DetailTransaction').button('reset'); }, 900);
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate); 
 $("#DocNum2Search").val(data.DocNum); 
 $("#DocNumDetailSearch").val(data.DocNumDetail);
 $("#DocNumDetail3Search").val(data.DocNumDetail3);  
 $("#ItemIDSearch").val(data.ItemID); 
 $("#PartNoSearch").val(data.PartNo);
 $("#PartNameSearch").val(data.PartName);
 $("#IDCustSearch").val(data.IDCust);
 $("#CustNameSearch").val(data.CustName2);
 $("#StockWipSearch").val(data.StockWip);  
 $("#BalanceWipSearch").val(data.StockWip); 
 $("#DocNumExtSearch").val(data.SourceDocNum); 
 $("#QtySearch").val(data.Qty);
 $("#QtyPlanSearch").val(data.QtyPlan);
 $("#NGSearch").val(data.NG);
 $("#TotalSearch").val(data.Yield);
 $("#AchievementSearch").val(data.Achievement); 
 $("#QCCheckSearch").val(data.QCCheck) ;
 $("#OP1Search").val(data.OP1) ;
 $("#OP2Search").val(data.OP2) ;
 $("#StatusSearch").val(data.StatusID) ;
 $("#SeparatingSearch").val(data.Separating) ;
 $("#QtyStrokeSearch").val(data.QtyStroke) ;
 $("#QtyStrokePlanSearch").val(data.QtyStrokePlan) ;
 $("#StdPackSearch").val(data.StdPack) ;
 $("#RemarkSearch").val(data.Remark) ;
 $("#ShiftIDSearch").val(data.ShiftID) ; 
 $("#IDLineSearch").val(data.Line+' - '+data.IDLineDetail) ; 
 $("#ProsesDSearch").val(data.ProsesD) ;
 $("#ProsesHSearch").val(data.ProsesH) ;
 $("#ProsesDHSearch").val(data.ProsesD+'/'+data.ProsesH+' '+data.Proses) ; 
 $("#StartSearch").val(data.Start) ;
 $("#FinishSearch").val(data.Finish) ;
 $("#ProsesProductionSearch").val(data.ProsesProduction) ;
 $("#DurasiSearch").val(data.Durasi) ;   
 }  });  };    
                 
 $("#DocNumDetail2").focusout(function(){
	var  DocNumDetail2 = $("#DocNumDetail2").val();
    if(DocNumDetail2.length==0){
	AmbilForm();
    Detail_data();
    hitung();}
	});    
$("#DocNumDetail2").focus(function(e){
 var isi = $(e.target).val();
 AmbilFormEdit();
 Detail_data();
 hitung(); });
 
$("#DocNumDetail2").keyup(function(){
 AmbilFormEdit();
 Detail_data();
 hitung(); });
    
$("#DocNumDetail2").click(function(e){
 var isi = $(e.target).val();
 AmbilFormEdit();
 Detail_data();
 hitung(); });
     
$("#StockWIP2").click(function(e){
 var isi = $(e.target).val();
 Detail_data(); });
 
$("#StockWIP2").focus(function(e){
	var isi = $(e.target).val();
    Detail_data();
	});

function AmbilFormEdit(){
 var x = $("#DocNumDetail2").val();
 var y = "STP" ;
 if(x.match(y)){
 var kode = $("#DocNumDetail2").val();
 }else{
 var kode = "" ;  }
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoDataEditProd",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#DocNum").val(data.DocNum); 
 $("#DocNumDetail").val(data.DocNumDetail);
 $("#DocNumDetail3").val(data.DocNumDetail3); 
 $("#ItemID").val(data.ItemID); 
 $("#PartNo").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#IDCust").val(data.IDCust);
 $("#CustName").val(data.CustName2)
 $("#Spec1").val(data.Spec1);
 $("#Spec2").val(data.Spec2);
 $("#PcsPerDay").val(data.PcsPerday);
 $("#StockWip").val(data.StockWip);  
 $("#BalanceWip").val(data.StockWip);
 $("#DocNumExt").val(data.SourceDocNum);
 $("#Qty").val(data.Qty);
 $("#QtyPlan").val(data.QtyPlan);
 $("#NG").val(data.NG);
 $("#Total").val(data.Yield);
 $("#Achievement").val(data.Achievement);
 $("#QCCheck").val(data.QCCheck) ;
 $("#OP1").val(data.OP1) ;
 $("#OP2").val(data.OP2) ;
 $("#Status").val(data.StatusID) ;
 $("#Separating").val(data.Separating) ;
 $("#QtyStroke").val(data.QtyStroke) ;
 $("#QtyStrokePlan").val(data.QtyStrokePlan) ;
 $("#StdPack").val(data.StdPack) ;
 $("#Remark").val(data.Remark) ;
 $("#ShiftID").val(data.ShiftID) ;
 $("#IDLine").val(data.IDLine) ;
 $("#IDLineDetail").val(data.IDLineDetail) ;
 $("#ProsesD").val(data.ProsesD) ;
 $("#ProsesH").val(data.ProsesH) ;
 $("#Start").val(data.Start) ;
 $("#Finish").val(data.Finish) ;
 $("#ProsesProduction").val(data.ProsesProduction) ;
 $("#Durasi").val(data.Durasi) ;
 }  });  };
    
$("#DocNum2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#DocNum2").keydown(function(){ Detail_data2(); });
$("#DocNum2").keyup(function(){ Detail_data2(); });
$("#DocNum2").click(function(){ Detail_data2(); });
$("#DocNum2").focus(function(){ Detail_data2(); });

 
$("#DocNumDetail2").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
$("#ReCheck").click(function(){ hitung(); });

$("#StdPack").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });

function Detail_data2(){
 var kode = $("#DocNum2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/DataDetailMatIn2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data2").html(data);
 waitingDialog3.hide(); } }); }
    
$("#QtyPlan").focus(function(){
 var  QtyPlan = $("#QtyPlan").val();
 if(QtyPlan == 0){ $("#QtyPlan").val(""); hitung(); return false();}  });
$("#QtyPlan").focusout(function(){
 var  QtyPlan = $("#QtyPlan").val();
 if(QtyPlan.length==0){ $("#QtyPlan").val("0");  hitung(); return false(); } });
$("#Qty").focus(function(){
 var  Qty = $("#Qty").val();
 if(Qty == 0){ $("#Qty").val(""); hitung(); return false(); } });
 $("#Qty").focusout(function(){
 var  Qty = $("#Qty").val();
 if(Qty.length==0){ $("#Qty").val("0"); hitung(); return false(); }  });
        
$("#NG").focus(function(){ var  NG = $("#NG").val();
 if(NG == 0){ $("#NG").val(""); hitung(); return false(); }  });
$("#NG").focusout(function(){ var  NG = $("#NG").val();
 if(NG.length==0){ $("#NG").val("0"); hitung(); return false(); } });
    
$("#Qty").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
$("#QtyPlan").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
$("#NG").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
        
    
function HitungMenit(){
 var Start = new Date($("#Start").val());
 var Finish = new Date($("#Finish").val());
 var StartMinute = Math.abs(Start.getMinutes());
 var FinishMinute = Math.abs(Finish.getMinutes());
 var StartHours = Math.abs(Start.getHours());
 var FinishHours = Math.abs(Finish.getHours());
 var DiffHours = Math.abs(Finish.getHours() - Start.getHours());  
 if(StartHours>FinishHours ){
 if(StartMinute>FinishMinute ){
 var DurasiJam =  ((23 - Start.getHours()) + Finish.getHours()) * 60  ; }else{
 var DurasiJam =  ((24 - Start.getHours()) + Finish.getHours()) * 60  ;    
 } }else{ 
 if(StartMinute>FinishMinute ){
 var DurasiJam = ((Finish.getHours() - Start.getHours()) * 60) - 60 ; }else{
 var DurasiJam = (Finish.getHours() - Start.getHours()) * 60 ;  }}
 var timeDiff = Math.abs(Finish.getMinutes() - Start.getMinutes() + parseInt(DurasiJam));
 var timeDiff2 = Math.abs((60 - Start.getMinutes()) + Finish.getMinutes() + parseInt(DurasiJam));
 if(StartMinute>FinishMinute ){
 var Durasi = timeDiff2; 
 }else{ var Durasi = timeDiff ; } ;
 $("#Durasi").val(Durasi);  }
        
function hitung(){
 var Qty = $("#Qty").val();
 var QtyPlan = $("#QtyPlan").val();
 var NG = $("#NG").val();
 var Separating = $("#Separating").val();
 var Total = parseFloat(Qty) - parseFloat(NG);
 $("#Total").val(Total);
 var QtyStroke = Math.ceil(parseFloat(Qty) / parseFloat(Separating));
 $("#QtyStroke").val(QtyStroke);
 var QtyStrokePlan = Math.ceil(parseFloat(QtyPlan) / parseFloat(Separating));
 $("#QtyStrokePlan").val(QtyStrokePlan);
 var Achievement = (parseFloat(Qty) / parseFloat(QtyPlan)) * 100 ;
 $("#Achievement").val(Achievement); }
    
$("#Qty").keyup(function(){ hitung(); HitungMenit(); }); 
$("#QtyPlan").keyup(function(){hitung(); HitungMenit(); }); 
$("#Separating").change(function(){ hitung(); HitungMenit(); });              
$("#NG").keyup(function(){ hitung(); HitungMenit(); });
$("#Start").focusout(function(){ HitungMenit(); }); 
$("#Finish").focusout(function(){ HitungMenit(); });
 

              
$("#Qty").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
 
$("#NG").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
 
$("#Home3").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
 
$("#Home4").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
        
    
$("#form-tab").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click();
 waitingDialog3.hide(); },300) ; ta}, 1000); });	
    
$("#form-tab2").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click(); },300) ;
 ta}, 1000);  });
    
$("#form-tab3").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click();
 },300) ; ta}, 1000); });
    
function AmbilForm(){
 var kode = "";
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormProduction",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#DocNum").val(data.DocNum);
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#DocDate").val(data.DocDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocNumDetail3").val(""); 
 $("#DocNumDetail2").val("");
 $("#ItemID").val("");
 $("#PartNo").val("");
 $("#PartName").val("");
 $("#IDCust").val("");
 $("#CustName").val("");
 $("#PcsPerDay").val("");
 $("#Qty").val("0");
 $("#QtyPlan").val("0");
 $("#NG").val("0");
 $("#StdPack").val(""); 
 $("#ShiftID").val(""); 
 $("#Start").val(data.Start); 
 $("#Finish").val(data.Finish);   
 $("#Total").val("0");
 $("#QCCheck").val("");
 $("#OP1").val("") ;
 $("#OP2").val("") ;
 $("#Status").val("");
 $("#Separating").val("1") ;
 $("#QtyStroke").val("0") ;
 $("#QtyStrokePlan").val("0") ; 
 $("#StdPack").val("");
 $("#Remark").val("");
 $("#Achievement").val("0");
 $("#IDLine").val("");
 $("#IDLineDetail").val("");
 $("#ProsesD").val("");
 $("#ProsesH").val("");
 }  });  };
             
  
$('#tab_tambah_detail').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 AmbilFormDetail();
 Detail_data(); Detail_data2();
 }, 300); });
       
function AmbilFormDetail(){
 var kode = $("#DocNum").val();
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ref_json/InfoTambahFormDetailProduction",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#DocDate").val(data.DocDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocNumDetail3").val(""); 
 $("#DocNumDetail2").val("");
 $("#PartNo").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#IDCust").val(data.IDCust);
 $("#CustName").val(data.CustName2)
 $("#PcsPerDay").val(data.PcsPerday); 
 $("#ShiftID").val(data.ShiftID); 
 $("#Qty").val("0");
 $("#QtyPlan").val("0");
 $("#Total").val("0");
 $("#NG").val("0"); 
 $("#StdPack").val("");
 $("#Start").val(data.Start); 
 $("#Finish").val(data.Finish);   
 $("#Total").val("0");
 $("#QCCheck").val("");
 $("#OP1").val("") ;
 $("#OP2").val("") ;
 $("#Status").val("");
 $("#Separating").val("1") ;
 $("#QtyStroke").val("0") ;
 $("#QtyStrokePlan").val("0") ; 
 $("#StdPack").val("");
 $("#Remark").val("");
 $("#Achievement").val("0");
 $("#IDLine").val("");
 $("#IDLineDetail").val("");
 $("#ProsesD").val("");           
 }  });  };
             
$("#tab_tambah_detail").focus(function(e){
 var isi = $(e.target).val();
 Detail_data();  AmbilFormDetail(); });
 
$("#tab_tambah_detail").keyup(function(){
 Detail_data(); AmbilFormDetail();	 });
    
function Detail_data(){
 var kode = $("#DocNum").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/DataDetailMatIn",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data").html(data);
 waitingDialog3.hide(); } });
 }
    
$("#ItemID").focus(function(e){
 var isi = $(e.target).val();
 CariProfilProduct(); });

$("#ItemID").keyup(function(){
 CariProfilProduct(); });
	
function CariProfilProduct(){
 var kode = $("#ItemID").val();
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#PartNo").val(data.PartNo);
 $("#PartName").val(data.PartName);
 $("#IDCust").val(data.IDCust);
 $("#CustName").val(data.CustName2)
 $("#PcsPerDay").val(data.PcsPerday); 
 $("#Qty").val("0");
 $("#QtyPlan").val("0");
 $("#Total").val("0");
 $("#NG").val("0");   
 $("#QCCheck").val("");
 $("#OP1").val("") ;
 $("#OP2").val("");   
 $("#StdPack").val(""); 
 $("#Remark").val("");       
 }  });  };
             
$.fn.capitalize = function () {
 $.each(this, function () {
 var split = this.value.split(' ');
 for (var i = 0, len = split.length; i < len; i++) {
 split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);  }
 this.value = split.join(' '); });
 return this; };
    
$("#OP1").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
$("#OP2").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
$("#Remark").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
    
$("#DocNumExt").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
  
$("#Save").click(function(){
 var DocNum = $("#DocNum").val();
 var ItemID = $("#ItemID").val();
 var Qty = $("#Qty").val(); 
 var QtyPlan = $("#QtyPlan").val(); 
 var NG = $("#NG").val();
 var Total = $("#Total").val();
 var ShiftID = $("#ShiftID").val();
 var IDLine = $("#IDLine").val();
 var IDLineDetail = $("#IDLineDetail").val();
 var ProsesD = $("#ProsesD").val();
 var ProsesH = $("#ProsesH").val();
 var Status = $("#Status").val();
 var Separating = $("#Separating").val();
 var ProsesProduction = $("#ProsesProduction").val();
 var string = $("#form").serialize();
 if(DocNum.length==0){ NotifFail('Data Gagal di simpan, Silahkan Klik Tambah Doc. dan coba lagi'); return false(); }
 if(ItemID.length==0){ NotifFail('Silahkan klik "PartNo" untuk mengisi product'); return false(); }
 if(IDLine.length==0){ NotifFail('Line harus di isi'); return false(); }
 if(IDLineDetail.length==0){ NotifFail('Detail Line harus di isi'); return false(); }
 if(ProsesD.length==0){ NotifFail('Proses harus di isi'); return false(); }
 if(ProsesH.length==0){ NotifFail('Proses harus di isi'); return false(); }
 if(ProsesH<ProsesD){ NotifFail('Check Proses'); return false(); }
 if(ProsesProduction.length==0){ NotifFail('Nama Proses harus di isi'); return false(); }
 if(Status.length==0){ NotifFail('Status harus di isi'); return false(); }
 if(Separating<=0){ NotifFail('Separating harus diisi'); return false(); }
 if(QtyPlan.length==0){ NotifFail('Plan Produksi tidak boleh dikosongkan'); return false(); }
 if(QtyPlan==0){ NotifFail('Plan Produksi tidak boleh dikosongkan'); return false(); }
 if(Qty.length==0){ NotifFail('Actual Produksi tidak boleh dikosongkan');  return false(); }       
 if(ShiftID.length==0){  NotifFail('Shift harus diisi'); return false(); }
 if(Total<0){ NotifFail('Check Qty NG'); return false(); }
 if(NG.length==0){ NotifFail('Check Qty NG tidak boleh dikosongkan'); return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/OutSTP/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 Detail_data(); AmbilFormDetail();
 NotifSuccsess(data); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false();	 });
    
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
 var IDCust2 = $("#IDCust2").val();
 var Factory = $("#Factory").val();
 var IDLine2 = $("#IDLine2").val();
 var PartNo2 = $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCust2="+IDCust2+"&IDLine2="+IDLine2+"&tgl1="+tgl1+"&tgl2="+tgl2+"&PartNo2="+PartNo2+"&Factory="+Factory;
 if(tgl1.length==0){
 $("#myModal4").modal('show');
 $("#pesan4").text('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length==0){
 $("#myModal4").modal('show');
 $("#pesan4").text('Tanggal tidak boleh kosong'); return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 $("#transaction_detail_report").html('');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/ReadReport",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#transaction_detail_report").html(data); },1000) } }); return false(); });

    
$("#DownloadReport").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var Factory = $("#Factory").val();
 var IDLine2 = $("#IDLine2").val();
 var PartNo2 = $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+Factory+"/"+IDLine2+"/"+IDCust2+"/"+PartNo2;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong') ; return false(); }
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }

$("#DownloadReport").button('loading');
setTimeout(function(){
$("#DownloadReport").button('reset'); }, 1000);
window.open('<?php echo site_url();?>/OutSTP/ExportReport/'+string); 
 return false(); });
    
$("#PrintReport").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var Factory = $("#Factory").val();
 var IDLine2 = $("#IDLine2").val();
 var PartNo2 = $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+Factory+"/"+IDLine2+"/"+IDCust2+"/"+PartNo2;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }
 
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 

$("#PrintReport").button('loading');
setTimeout(function(){
$("#PrintReport").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/OutSTP/PrintReport/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false(); });
    
function BackHome(){ window.location.replace("<?php echo base_url();?>index.php/OutSTP/"); }

$("#HapusDetail").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 var BalanceDelete = $("#BalanceDelete").val();
 var ItemIDDelete = $("#ItemIDDelete").val();
 
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/Hapus_Transaksi",
 data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&BalanceDelete="+BalanceDelete+"&ItemIDDelete="+ItemIDDelete,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 NotifFail(data);
 $("#Reload1").click(); $("#tab_tambah_detail").click();  },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show'); $("#ReloadSearch").click();
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false(); });



$("#PrintList2").click(function(){
 var kode	= $("#DocNum2").val();
 window.open('<?php echo site_url();?>/OutSTP/PrintList/'+kode , 'myWindow', 
 'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
 return false(); });

 

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList(); });
      
function MasterList(){
 var kode = "" ;
 $("#MasterList").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/MasterList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };
 
$('#ReloadSearch').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 List_Material(); });

$("#DocNumModalSearch").focus(function(e){
 var isi = $(e.target).val(); List_Material(); });
$("#DocNumModalSearch").keyup(function(){ List_Material(); });
$("#DocNumModalSearch").keyup(function(){ List_Material(); });
          
function List_Material(){
 var kode = $("#DocNumModalSearch").val();
 $("#List_Material").html("");
 $('#ReloadSearch').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OutSTP/DataDetailMatIn3",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadSearch').button('reset'); }, 900);
 setTimeout(function() {
 $("#List_Material").html(data); }, 700); } }); };
 
 $("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){
 $("#DocNumSearchButton").click();
    } });

$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#ItemID").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#PartNo").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
   
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
<div id="tampil_data"></div>
</div></div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal"  name="form" id="form">
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
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-3">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-5">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-4">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="Total" name="Total"  class="form-control" readonly="readonly" placeholder="Total OK">
</div> </div> 

<div class="form-group">
<label class="col-xs-4 control-label">Line</label>
<div class="col-xs-4">
<select name="IDLine" id="IDLine" class="form-control">
<?php if(empty($Line)){ ?>
<option value="">Pilih Line</option>
<?php } foreach($l_MLine->result() as $t){ if($Line==$t->Line){ ?>
<option value="<?php echo $t->IDLine;?>" selected="selected"><?php echo $t->IDLine;?> - <?php echo $t->Line;?></option>
<?php }else { ?>
<option value="<?php echo $t->IDLine;?>"><?php echo $t->Line;?></option>
<?php } } ?>  </select> </div> 

<div class="col-xs-4">
<select name="IDLineDetail" id="IDLineDetail" class="form-control">      
<option value="">Detail Line</option>
    <option >1</option>
    <option >2</option>
    <option >3</option>
    <option >4</option>
    <option >5</option>
    <option >6</option>
    </select></div> 
    
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Proses</label>
<div class="col-xs-4">
<select name="ProsesD" id="ProsesD" class="form-control">      
<option value="">PILIH</option>
    <option >1</option>
    <option >2</option>
    <option >3</option>
    <option >4</option>
    <option >5</option>
    <option >6</option>
    <option >7</option>
    </select></div> 
        
<div class="col-xs-4">
<select name="ProsesH" id="ProsesH" class="form-control">
<?php if(empty($ProsesH)){ ?>
<option value="">PILIH</option>
<?php } foreach($l_ProsesH->result() as $t){ if($ProsesH==$t->ProsesH){ ?>
<option value="<?php echo $t->ProsesH;?>" selected="selected"><?php echo $t->ProsesH;?></option>
<?php }else { ?>
<option value="<?php echo $t->ProsesH;?>"><?php echo $t->ProsesH;?></option>
<?php } } ?>  </select> </div> 

    </div>
    

<div class="form-group">
<label class="col-xs-4 control-label">Nama Proses</label>
<div class="col-xs-8">
<select name="ProsesProduction" id="ProsesProduction" class="form-control">
<?php if(empty($ProsesProduction)){ ?>
<option value="">PILIH</option>
<?php } foreach($M_ProsesProduction->result() as $t){ if($ProsesProduction==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->Description;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->Description;?></option>
<?php } } ?>  </select> </div> 
     </div>
     

<div class="form-group">
<label class="col-xs-4 control-label">Status</label>
<div class="col-xs-8">
<select name="Status" id="Status" class="form-control">      
<option value="">-PILIH-</option>
    <option value="1">WIP</option>
    <option value="2">FG</option>
    </select></div>
     </div>
     
<div class="form-group">
<label class="col-xs-4 control-label">Separating/Gang</label>
    <div class="col-xs-8">
<select name="Separating" id="Separating" class="form-control" > 
    <option value="1">No Separating/Gang</option>
    <option value="2">Separating/Gang</option>
    </select></div>
     </div>

<div class="form-group">
<label class="col-xs-4 control-label">Plan Produksi</label>
<div class="col-xs-8">
<input type="text" id="QtyPlan" name="QtyPlan" placeholder="Qty Plan" value="0" class="form-control">
</div></div>
    
<div class="form-group">
<label class="col-xs-4 control-label">Actual Produksi</label>
<div class="col-xs-4">
<input type="text" id="Qty" name="Qty" value="0" class="form-control">
</div>
<div class="col-xs-4">
<input type="text" id="NG" name="NG" value="0" class="form-control" placeholder="NG">
</div>
</div>
</div>
            
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Shift</label>
<div class="col-xs-8">
<select name="ShiftID" id="ShiftID" class="form-control">
<?php if(empty($Shift)){ ?>
<option value="">PILIH</option>
<?php } foreach($M_Shift->result() as $t){ if($Shift==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php } } ?>  </select> </div> 
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Start</label>
<div class="col-xs-8">
<input type="text" class="form-control" id="Start" name="Start"/>
</div>
</div> 

<div class="form-group">
<label class="col-xs-4 control-label">Finish</label>
<div class="col-xs-8">
<input type="text" class="form-control" id="Finish" name="Finish"/>
</div>
</div> 

<div class="form-group">
<label class="col-xs-4 control-label">Packing Standart</label>
<div class="col-xs-8">
<input type="text" id="StdPack" name="StdPack"  class="form-control">
</div></div>
  
<div class="form-group">
<label class="col-xs-4 control-label">QC Check</label>
<div class="col-xs-8">
<select name="QCCheck" id="QCCheck" class="form-control">
<?php if(empty($QCCheck)){ ?>
<option value="">QC Check</option>
<?php } foreach($QCCheck->result() as $t){ if($QCCheck==$t->QCCheck){ ?>
<option value="<?php echo $t->QCCheck;?>" selected="selected"><?php echo $t->QCCheck;?></option>
<?php }else { ?>
<option value="<?php echo $t->QCCheck;?>"><?php echo $t->QCCheck;?></option>
<?php } } ?>  </select> </div> 
</div>

<div class="form-group">
<label class="col-xs-4 control-label">OP 1</label>
<div class="col-xs-8">
<input type="text" id="OP1" name="OP1"  class="form-control" placeholder="Operator 1">
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">OP 2</label>
<div class="col-xs-8">
<input type="text" id="OP2" name="OP2"  class="form-control" placeholder="Operator 2">
</div></div>


<div class="item form-group">
<label class="col-xs-4 control-label">Remark</label>
<div class="col-xs-8">
<textarea id="Remark" name="Remark" class="form-control col-md-2 col-xs-8" placeholder="Contoh : 'Cancel Schedule'" style="resize: none;"></textarea>
</div></div>

</div>


</div></div></div></div>


<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Properties &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse">
<div class="panel-body">
    
<div class="col-md-6">        
<div class="form-group">
<label class="col-xs-4 control-label">DocNum</label>
<div class="col-xs-4">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-8">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Durasi</label>
<div class="col-xs-8">
<input type="text" id="Durasi" name="Durasi"  class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Qty Stroke</label>
<div class="col-xs-4">
<input type="text" id="QtyStroke" name="QtyStroke" class="form-control"  readonly="readonly"> 
</div>
<div class="col-xs-4">
<input type="text" id="QtyStrokePlan" name="QtyStrokePlan" class="form-control" readonly="readonly">
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Achievement</label>
<div class="col-xs-4">
<input type="text" id="Achievement" name="Achievement" class="form-control"  readonly="readonly"> 
</div>
<div class="col-xs-4">
<input type="text" id="" name="" value="%" class="form-control"  readonly="readonly"> 
</div></div>


</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">CreateDate</label>
<div class="col-xs-8">
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly" value="<?php echo $DocDateReport_2 ;?>">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocTime</label>
<div class="col-xs-8">
<input type="text" id="CreateTime" name="CreateTime"  class="form-control"  readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-xs-4 control-label">DocDate</label>
<div class="col-xs-8">
<input type="text" id="DocDate" name="DocDate"  class="form-control" readonly="readonly" value="<?php echo $DocDateReport_2 ;?>"> 
</div></div>
</div>
</div></div></div></div></form>


<div class="box-body panel-footer">
<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<button type="button" name="Save" id="Save" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
<button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?> <?php } ?>  
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab2" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-file-o"></i> New</a><?php } ?>
</div></div>
<form class="pull-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetail2" name="DocNumDetail2" class="form-control" placeholder="Search"></div>
</form></div>
</div>
<div class="box-body"><div class="box"><div class="box-body">
<div id="Detail_data"></div>
</div></div></div></div></div></div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a onfocus="PilihTambah()" href="#tab_content2" data-toggle="tab" aria-expanded="false" class="btn btn-warning" ><i class="glyphicon glyphicon-plus"></i> Add</a>
<?php } ?>
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-reply"></i> Closed</a>
<button type="button" class="btn btn-success" id="Reload1" name="Reload1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
</div></div>
<div class="pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNum2" name="DocNum2" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="Detail_data2"></div>
</div></div></div>
</div></div></div>

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
<label class="col-xs-4 control-label">Factory</label>
<div class="col-xs-8">
<select name="Factory" id="Factory" class="form-control" style="width: 100%;">
<option value="ALL">All Factory</option>
<option value="A">Gedung A</option>
<option value="B">Gedung B</option>
<option value="C">Gedung C</option>
<option value="D">Gedung D</option>
<option value="E">Gedung E</option>
<option value="F">Gedung F</option>
</select> </div> 
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Line</label>
<div class="col-xs-8">
<select name="IDLine2" id="IDLine2" class="form-control" style="width: 100%;">
<?php if(empty($Line)){ ?>
<option value="ALL">All Line</option>
<?php } foreach($l_MLine->result() as $t){ if($Line==$t->Line){ ?>
<option value="<?php echo $t->IDLine;?>" selected="selected"><?php echo $t->IDLine;?> - <?php echo $t->Line;?></option>
<?php }else { ?>
<option value="<?php echo $t->IDLine;?>"><?php echo $t->Line;?></option>
<?php } } ?>  </select> </div> 
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select name="IDCust2" id="IDCust2" class="form-control" style="width: 100%;">
<option value="ALL">All Customer</option>
<?php foreach($l_cust->result() as $t){?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } ?></select>
</div></div>
                
    <div class="form-group">
<label class="col-xs-4 control-label">PartNo</label>
<div class="col-xs-8">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" >
</div></div>
</div></div>
</div></div></div>
</form>
</div>
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" class="btn btn-success" id="DownloadReport" name="DownloadReport" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>
<button type="button" class="btn btn-info" id="PrintReport" name="PrintReport" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<a href="#tab_content1" id="Home4" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-warning">
<i class="fa fa-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>

</div></div></div></div></div>
</div></div>
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="transaction_detail_report"></div>
</div></div></div>
</div></div></div>


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
<input hidden="true" type="text" id="BalanceDelete" name="BalanceDelete" readonly="true" >
<input hidden="true" type="text" id="ItemIDDelete" name="ItemIDDelete" readonly="true" >
<input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
</form>
</div>
</div></div></div></div></div><!-- /.modal -->


<div class="modal fade" id="myModal_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>


 <div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="DetailTransaction" name="DetailTransaction" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Detail Transaction</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<form class="form-horizontal"  name="formSearch" id="formSearch">
<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#productSearch"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="productSearch" class="collapse in">
<div class="panel-body">


<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-3">
<input type="text" id="ItemIDSearch" name="ItemIDSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-5">
<input type="text" id="PartNoSearch" name="PartNoSearch"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartNameSearch" name="PartNameSearch" class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">Customer</label>
<div class="col-lg-4">
<input type="text" id="CustNameSearch" name="CustNameSearch" class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="IDLineSearch" name="IDLineSearch"  class="form-control" readonly="readonly" readonly="true">
</div> </div> 

<div class="form-group">
<label class="col-lg-4 control-label">Proses</label>
<div class="col-lg-8">
<input type="text" id="ProsesDHSearch" name="ProsesDHSearch"  class="form-control" readonly="readonly" readonly="true">
</div>
    </div>
    


<div class="form-group">
<label class="col-lg-4 control-label">Plan Produksi</label>
<div class="col-lg-8">
<input type="text" id="QtyPlanSearch" name="QtyPlanSearch" value="0" class="form-control" readonly="true">
</div></div>
    
<div class="form-group">
<label class="col-lg-4 control-label">Actual Produksi</label>
<div class="col-lg-4">
<input type="text" id="QtySearch" name="QtySearch" value="0" class="form-control" readonly="true">
</div>
<div class="col-lg-4">
<input type="text" id="NGSearch" name="NGSearch" value="0" class="form-control" placeholder="NG" readonly="true">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Packing Standart</label>
<div class="col-lg-8">
<input type="text" id="StdPackSearch" name="StdPackSearch"  class="form-control" readonly="true">
</div></div>
    
  </div>

          
<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">Shift</label>
<div class="col-lg-8">
<select name="ShiftIDSearch" id="ShiftIDSearch" class="form-control" disabled="true">
<?php if(empty($Shift)){ ?>
<option value="">PILIH</option>
<?php } foreach($M_Shift->result() as $t){ if($Shift==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php } } ?>  </select> </div> 
</div>

    <div class="form-group">
    <label class="col-lg-4 control-label">Start</label>
<div class="col-lg-8">
    <input type="text" id="StartSearch" name="StartSearch" class="form-control" readonly="true">
</div></div>
                
    <div class="form-group">
    <label class="col-lg-4 control-label">Finish</label>
<div class="col-lg-8">
    <input type="text"  id="FinishSearch" name="FinishSearch" class="form-control" readonly="true">
</div></div>
  
<div class="form-group">
<label class="col-lg-4 control-label">QC Check</label>
<div class="col-lg-8">
<select name="QCCheckSearch" id="QCCheckSearch" class="form-control" disabled="true">
<?php if(empty($QCCheck)){ ?>
<option value="">QC Check</option>
<?php } foreach($QCCheck->result() as $t){ if($QCCheck==$t->QCCheck){ ?>
<option value="<?php echo $t->QCCheck;?>" selected="selected"><?php echo $t->QCCheck;?></option>
<?php }else { ?>
<option value="<?php echo $t->QCCheck;?>"><?php echo $t->QCCheck;?></option>
<?php } } ?>  </select> </div> 
</div>

<div class="form-group">
<label class="col-lg-4 control-label">OP</label>
<div class="col-lg-4">
<input type="text" id="OP1Search" name="OP1Search"  class="form-control" placeholder="Operator 1" readonly="true">
</div>
<div class="col-lg-4">
<input type="text" id="OP2Search" name="OP2Search"  class="form-control" placeholder="Operator 2" readonly="true">
</div></div>


<div class="item form-group">
<label class="col-lg-4 control-label">Remark</label>
<div class="col-lg-8">
<textarea id="RemarkSearch" name="RemarkSearch" class="form-control col-md-2 col-xs-8" placeholder="Contoh : 'Cancel Schedule'" style="resize: none;" readonly="true"></textarea>
</div></div>

</div>


</div></div></div></div>

</form>

    <div class="panel-footer">
    <?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
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
$(function () {
$('#Start').datetimepicker({
 locale: 'id', format: 'L' }); });
</script>
<script type="text/javascript">
$(function () {
$('#Finish').datetimepicker({
 locale: 'id', format: 'L'  }); });
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
 $("#DocNumDetail2").click();   $("#myModal_Search").modal("hide");
 },300) ;
 },500) ;
 return false(); }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,BalanceDelete,ItemIDDelete,QtyDelete,NGDelete){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
var BalanceDeleteX = (parseFloat(BalanceDelete) + parseFloat(NGDelete)) - parseFloat(QtyDelete) ;
$("#BalanceDelete").val(BalanceDeleteX);
$("#ItemIDDelete").val(ItemIDDelete);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
 
<script type="text/javascript"> 
function PilihTambah(){
 var  DocNum2 = $("#DocNum2").val(); 
 setTimeout(function(){
 $("#DocNum").val(DocNum2);
 setTimeout(function(){
 $("#tab_tambah_detail").focus();
 $("#tab_tambah_detail").click();
 Detail_data();
 },300) ;
 },500) 
 return false(); }
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
$("#DetailTransaction").click();
},500) 
return false();  } }
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
  $(function (){
    //Initialize Select2 Elements PartnerID2 PartnerID2
    $("#IDCust2").select2(); $("#IDLine2").select2(); $("#Factory").select2();
    //Datemask dd/mm/yyyy
   
    //Date picker
    $('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#SJDate').datepicker({
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
