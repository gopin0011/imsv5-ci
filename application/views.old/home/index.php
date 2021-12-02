<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $("#TutupComment").click(function(){
	$("#myModalCom").modal('hide');
    tampil_data();
	}); 

$('#Reload').load('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });
 
$('#Reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });
 
function tampil_data(){
var kode = "";
 $('#Reload').button('loading');
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/data_detail",
			data	: "kode="+kode,
			cache	: false,
			success	: function(html){
				$("#tampil_data").html(html);
                 setTimeout(function(){
                $('#Reload').button('reset'); },1000)	
			}
		});
		//return false();
	};
    
    
 
    function textAreaAdjust2() {
    style.height = "5px";
    style.height = (22+scrollHeight)+"px";
};

    

		
        

	
    $("#simpan").click(function(){
		var coment 	    = $("#coment").val();
		var string = $("#form").serialize();
		
        if(coment.length==0){
		  NotifFail('Silahkan masukan komentar anda !!!');
			return false();
		}
       $("#myModalCom").modal('hide');
       
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
			 		setTimeout(function(){
				    NotifSuccsess(data);
                    tampil_data();
				},200)
     
			},
			error : function(xhr, teksStatus, kesalahan) {
				NotifFail('Server tidak merespon :'+kesalahan);
			}		
		});
		return false();	
	});
 

       
    function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'info',
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
      
   function NotifFail(data){
        new PNotify({
        title: 'Info',
        type: 'error',
        text: data,
        hide: true
      }); }; 
      

    
});	
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<section class="content">
<div class="row">
<div class="col-lg-12 col-xs-12">
<div class="small-box bg-aqua">
<div class="inner">
<h3><em>Welcome</em>, <?php echo $this->session->userdata('nama_lengkap') ;?></h3>
<p>ICT Team 2014 ~ 2017</p>
</div>
<div class="icon">
<i class="fa fa-home"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
<div class="row">
<section class="col-lg-12 connectedSortable">
<div class="box box-success">
<div class="box-header">
<i class="fa fa-comments-o"></i>
<h3 class="box-title">Forums</h3>

<div class="box-tools pull-right" data-toggle="tooltip" title="Add Comment">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCom">
<i class="fa fa-wechat"></i> Comment
</button>

<button type="button" class="btn btn-success" id="Reload" name="Reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
</div></div></div>
<hr />

<div class="box-body chat" id="chat-box">
<div class="row">
<div class="col-md-12">
<div id="tampil_data">
</div></div>
</div>
</div>
</div>
</section>
</div>
</section>
</div>
  
  
  <div class="modal fade" id="myModalCom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg">
<div class="modal-content"><div class="modal-body"><div>
                        
<form class="form-horizontal"  name="form" id="form">
<div class="panel-body">
<div class="col-md-12">
<div class="form-group">
</div>

    <div class="form-group">
    <div class="box-body col-lg-12">
    <div>
    <textarea class="text" name="coment" id="coment" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
    </div>
    </div>
    </div>

    
    <div class="panel-footer">
        <button type="reset" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-send"></i> Send</button>
        <button type="button" id="TutupComment" class="btn btn-danger"><i class="fa fa-close"></i> Closed</button> 
   
    </div>
   
</div></div>
</form>
    
</div></div></div></div></div><!-- /.modal -->

  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg">
<div class="modal-content"><div class="modal-body"><div>
                        
<form class="form-horizontal"  name="form" id="form">
<div class="panel-body">
<div class="col-md-12">

<div id="pesan"></div>
   
</div></div>
</form>
    
</div></div></div></div></div><!-- /.modal -->

<script type="text/javascript"> 
function LikeAdd(code, IDTes){
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/home/LikeAdd",
 data	: "&code="+code+"&IDTes="+IDTes,
 cache	: true,
 success	: function(data){

 LikeAdd2(code, IDTes);  	} 	}); };
    
function LikeAdd2(code, IDTes){
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/home/JumlahLike",
 data	: "&code="+code+"&IDTes="+IDTes,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#"+code).val(data.QtyLike);
 }  });  }; 
    
function ViewComment(kode,kode2){
 $.ajax({
 type	: 'POST',
 url    : "<?php echo site_url(); ?>/home/ViewComment",
 data	: "&kode="+kode+"&kode2="+kode2,
 cache	: false,
 success : function(html){
 $("#"+kode2).html(html); }
 }); };


function Reload2(kode,kode2,kode3,code){
 setTimeout(function(){
 $("#"+kode3).click(); },100)
 $("#"+kode3).click(function(){
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/home/ViewComment",
 data	: "&kode="+kode+"&kode2="+kode2,
 cache	: false,
 success	: function(data){
 $("#"+kode2).html(data);
 } });	
 }); 
 
 };
 
function Reload3(kode,code){
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/home/JumlahLike",
 data	: "&code="+code,
 cache	: false,
 dataType : "json",
 success	: function(data){
 setTimeout(function(){
 $("#"+kode).val(data.QtyKomen); },100)
 }  });  }; 
 
function Save(IdComent,Coment,IDButton,IDButtonR,ButtonKolom){
 setTimeout(function(){
 $("#"+IDButton).click(); },100)
$("#"+IDButton).on('click', function() {
 var KomenX = $("#"+Coment).val();
 if(KomenX.length==0){ NotifSuccsess('Silahkan masukan komentar anda !!!'); return false(); }
  $("#"+Coment).val(""); $("#"+ButtonKolom).hide();
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/home/Save",
 data	: "&IdComent="+IdComent+"&KomenX="+KomenX,
 cache	: false,
 success	: function(data){
 BackHome();

function BackHome(){
 window.location.replace("<?php echo base_url();?>index.php/home/"); }
        
 } });	
 }); 
 
 };
            
      


</script>

