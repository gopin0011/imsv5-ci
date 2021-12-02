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

$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
         
tampil_data();
function tampil_data(){
var id = $("#DeptIDView").val() ;
 $('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterUserTR/ListProduct",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

$("#DeptIDView").change(function(){
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
 var code	    = $("#code").val();
 var nama_lengkap	= $("#nama_lengkap").val();
 var id_dept	    = $("#id_dept").val(); 
 var string = $("#form").serialize();
 if(code.length==0){ NotifFail('Kode User Harus Di isi');   return false(); } 
 if(nama_lengkap.length==0){ NotifFail('Nama Lengkap Harus Di isi');  return false(); } 
 if(id_dept.length==0){ NotifFail('Department Harus Di isi');  return false(); } 
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUserTR/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){ 
 $("#Home2").click(); },1000) 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#RegID").load(CariProfilProduct());
$("#RegID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
$("#RegID").keyup(function(){ CariProfilProduct();		});
	
function CariProfilProduct(){
 var kode = $("#RegID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMasterUser",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#username").val(data.username);
 $("#nama_lengkap").val(data.nama_lengkap);
 $("#level").val(data.IDLevel);
 $("#id_dept").val(data.id_dept);
 $("#dept").val(data.dept);
 $("#IsActive").val(data.IDBlokir);
 $("#blokir").val(data.Blokir);
 $("#code").val(data.code);
 }  });  };
             
$.fn.capitalize = function () {
 $.each(this, function () {
 var split = this.value.split(' ');
 for (var i = 0, len = split.length; i < len; i++) {
 split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);  }
 this.value = split.join(' '); });
 return this; };
    
$("#code").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
 
$("#nama_lengkap").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
             
$("#Hapus").click(function(){
 var RegID	    = $("#RegID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUserTR/Hapus_Product",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Home2").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
    
 $("#Hapus_User").click(function(){
 var RegID	    = $("#RegID").val();
 var PartNo	    = $("#nama_lengkap").val();
 if(RegID.length==0){
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
<select name="DeptIDView" id="DeptIDView" class="form-control col-xs-12" style="width: 100%;">
 <?php if(empty($id_dept_)){ ?>
 <option value="All">- Department -</option>
 <?php }
 foreach($l_MDept->result() as $t){ if($id_dept_==$t->Dept_Name){ ?>
 <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->Dept_Name;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option>
 <?php } } ?> 
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
</span> Data Customer &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse in">

<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Nama Singkat</label>
<div class="col-lg-8">
<input type="text" id="code" name="code"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">Full Name</label>
<div class="col-lg-8">
<input type="text" id="nama_lengkap" name="nama_lengkap"  class="form-control">
</div></div> 

</div> 
<div class="col-md-6">
<div class="form-group">
        <label class="col-lg-4 control-label">Department</label>      
 <div class="col-lg-8">
 <select name="id_dept" id="id_dept" class="form-control">
 <?php if(empty($id_dept_)){ ?>
 <option value="">Select</option>
 <?php } foreach($l_MDept->result() as $t){ if($id_dept_==$t->Dept_Name){ ?>
 <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->Dept_Name;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option> <?php } } ?> 
 </select> </div> </div>
 <div class="form-group">
 <label class="col-lg-4 control-label">Status</label>
 <div class="col-lg-8">
 <select name="IsActive" id="IsActive" class="form-control">
 <?php if(empty($blokir)){ ?>
 <option value="1">Active</option>
 <option value="0">Non Active</option>
 <?php }else{ ?>
 <option value="<?php echo $IDBlokir ;?>"><?php echo $blokir ;?></option>
 <option value="1">Active</option>
 <option value="0">Non Active</option>
 <?php } ?>
 </select>
 </div>
 </div> 
        
         <div class="form-group">
<label class="col-lg-4 control-label">ID</label>
<div class="col-lg-8">
<input type="text" id="RegID" name="RegID"  class="form-control" readonly="true">
</div></div>

</div>
</div></form>

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
 

<script> $(function () { $("#t_list_master").DataTable(); });</script>