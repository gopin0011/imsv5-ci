<script type="text/javascript">
$(document).ready(function(){

tampil_data(); 
function tampil_data(){
 var idX = $("#CustIDView2").val() ; 
 var idXX = $("#CustIDView").val() ; 
 
 if(idX.length==0){ var id = 1 ;}
 if(idX>=1){ var id = idX ; }
 
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MonitoringStock/ListProduct",
data	: "&id="+id+"&idXX="+idXX,
cache	: false,
success	: function(data){
NextID();

$("#tampil_data").html(data);
Data_Chart();
$('#reload').button('reset');
setTimeout(function() {
NextIDCust(); }, 32000);

} }); };

function NextID(){
 var id = $("#CustIDView").val() ;    
 $.ajax({   
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MonitoringStock/NextID",
 data	: "id="+id,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#CustIDView2").val(data.NOMOR);
 
 var X = $("#CustIDView2").val();
 var Y = parseFloat(X) + 1 ;
 
 setTimeout(function() {
 $("#CustIDView2").val(Y);
 }, 500) ;
  
 }  });  }; 
 
function NextIDCust(){
 var id = $("#CustIDView2").val() ;    
 $.ajax({   
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MonitoringStock/NextIDCust",
 data	: "id="+id,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#CustIDView").val(data.RegID);
 setTimeout(function() {
 $("#reload").click();
 }, 1000) ;
 }  });  }; 
 
$("#form-tab").click(function(){
 document.getElementById("form").reset(); });	
    
$("#CustIDView").change(function(){
 setTimeout(function() { $('#reload').click(); clearInterval(counter); }, 200); });
 
$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data();   }); });	
</script>


<div class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header" style="color: darkorange;">
<a href="<?php echo base_url(); ?>" class="navbar-brand"><b>MONITORING</b>Stock</a>
<div style="float: right;" class="col-md-3" navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
<div class="input-group">
<select name="CustIDView" id="CustIDView" class="form-control col-xs-12" style="width: 100%;">
<?php foreach($l_MCust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option> <?php } } ?> 
</select>
<span class="input-group-btn">
<button disabled="" type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i class="fa fa-refresh"></i></button>
 <input type="text" id="CustIDView2" hidden="" >
</span>
</div></div>  
</div></div></div>


<section class="content">
<div class="row">               
<div id="tampil_data"></div>
</div></section>
