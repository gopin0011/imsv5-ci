<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  
<script type="text/javascript">
$(document).ready(function(){
 
 
 setTimeout(function(){
 var Status = $("#Status").val() ;
 if(Status==0){
 SendMail();   
 } }, 3000) ;
  
$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); 
 });
    
tampil_data();
function tampil_data(){
 var id = $("#DocDate").val() ;
 $('#reload').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/DailyGAP/ListProduct",
 data	: "&id="+id,
 cache	: false,
 success	: function(data){
 $("#tampil_data").html(data);
 CheckStatusGAP();
 setTimeout(function() {
 $('#reload').button('reset');
 }, 1000)
 } }); };

$("#DocDate").change(function(){
setTimeout(function() { $('#reload').click();  }, 200); });


$("#Download").click(function(){
 var id = $("#DocDate").val();
 var string = id ;
$("#Download").button('loading');
setTimeout(function(){
$("#Download").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/DailyGAP/ExportList/'+string); 
 
 return false(); });
 
$('#Send').on('click', function(){
 var $this = $(this);
 $this.button('loading');
 SendMail();
 });
 
function SendMail(){
var id = $("#DocDate").val() ;
 $('#Send').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/DailyGAP/SendMailGAP",
data	: "&id="+id,
cache	: false,
success	: function(data){
NotifSuccsess(data);
setTimeout(function() {
$('#Send').button('reset'); }, 1000)
} }); };

function CheckStatusGAP(){
 var id = $("#DocDate").val() ;
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/DailyGAP/CheckStatusDailyGAP",
 data	: "&id="+id,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#Status").val(data.Status);
}  });  };               
                
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
          
   
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
<button type="button" class="btn btn-primary" id="Download" name="Download" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<?php  $cek = $this->session->userdata('DailyGAP')=='1'; if(!empty($cek)){ ?>
<button type="button" class="btn btn-info" id="Send" name="Send" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-send"></i>&nbsp; Send Mail</button>
<?php } ?>
<div class="col-xs-3 pull-right">
<div class="form-group">
<div class="col-xs-12">
<div class="input-group date">
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="DocDate" name="DocDate">
<input type="text" hidden="" readonly="" id="Status" name="Status">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
</div>          
</div>
</div></div>

</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="tampil_data"></div>
</div></div></div></div>

</div></div>


<script type="text/javascript"> 
function Pilih(id){
 $("#RegID").val(id);
 setTimeout(function(){
 $("#RegID").focus();
 $("#RegID").click(); },700) 
 return false(); }
</script>

<script>
  $(function () {
    
    $('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    });
    </script>