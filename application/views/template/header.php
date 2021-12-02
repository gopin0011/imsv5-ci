<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
$("#RegID2").load(CariProfilUser());
       
$("#RegID2").focus(function(e){
		var isi = $(e.target).val();
		CariProfilUser();
	});
	$("#RegID2").keyup(function(){
		CariProfilUser();	
	});
	
	function CariProfilUser(){
		var kode = $("#RegID2").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMasterUser",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){   
				$("#username2").val(data.username);
                $("#nama_lengkap2").val(data.nama_lengkap);
                $("#level").val(data.IDLevel);
                $("#id_dept").val(data.id_dept);
                $("#dept").val(data.dept);
                $("#IsActive").val(data.IDBlokir);
                $("#blokir").val(data.Blokir);
                
                $("#MUser").val(data.MUser);
                $("#MUserIMS").val(data.MUserIMS);
                $("#MUserTR").val(data.MUserTR);
                $("#MProdMaterial").val(data.MProdMaterial);
                $("#MProdStamping").val(data.MProdStamping);
                $("#MProdWelding").val(data.MProdWelding);
                $("#MProdDelivery").val(data.MProdDelivery);
                $("#MProdStoreRoom").val(data.MProdStoreRoom);
                $("#MPartner").val(data.MPartner);
                $("#MCategory").val(data.MCategory);
                $("#MUnit").val(data.MUnit);
                $("#MProdICT").val(data.MProdICT);
                $("#MProdGA").val(data.MProdGA);
                $("#MProdMTNM").val(data.MProdMTNM);
                $("#MProdMTNT").val(data.MProdMTNT);
                $("#MCust").val(data.MCust);
                $("#MProduct").val(data.MProduct);
                $("#MUtility").val(data.MUtility);
                
                $("#TrcMaterial").val(data.TrcMaterial);
                $("#TrcStamping").val(data.TrcStamping);
                $("#TrcWelding").val(data.TrcWelding);
                $("#TrcWH").val(data.TrcWH);
                $("#TrcStoreRoom").val(data.TrcStoreRoom);
                $("#TrcGA").val(data.TrcGA);
                $("#CanEditMaster").val(data.CanEditMaster);
                $("#TrcICT").val(data.TrcICT);
                $("#TrcGA").val(data.TrcGA);
                $("#CanEditDoc").val(data.CanEditDoc);
                $("#CanEditMaster").val(data.CanEditMaster);
                $("#TrcWIP").val(data.TrcWIP);     
			 }  });  };
             
        function BackHome(){
        window.location.href = location.href;
        }
             
    
$("#SimpanEditUser").click(function(){
 var username2	    = $("#username2").val();
 var nama_lengkap2	= $("#nama_lengkap2").val();
 var level	    = $("#level").val();
 var pwd	    = $("#pwd").val();
 var pwd2	    = $("#pwd2").val();
 var string = $("#formEditUser").serialize();
 if(username2.length==0){   
 $("#myModalWarning").modal('show');
 $("#pesan4").text('UserName Harus Di isi'); 
 return false(); } 
 if(nama_lengkap2.length==0){
 $("#myModalWarning").modal('show');
 $("#pesan4").text('Full Name Harus Di isi'); 
 return false(); } 
 if(pwd!==pwd2){
 $("#myModalWarning").modal('show');
 $("#pesan4").text('Password confirm tidak sama bro'); 
 return false(); }
 $("#myModalEditUser").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/SimpanEditByUser",
 data	: string,
 cache	: false,
 success	: function(data){
 var win = $("#myModalSuccess").modal('show');
                 $("#pesan").text(data);
                setTimeout(function(){
					$("#myModalSuccess").modal('hide');
                    BackHome ();
				},2000)
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
    
    $("#simpanFoto").click(function(){
        $("#myModalEditFotoUser").modal('hide');
        
	
	});
    
   

    
    $("#Tutup").click(function(){
	$("#myModalEditUser").modal('hide');
	}); 
	
	
});	
</script>

<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IMS</b>V5</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url(); ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>images/foto_profil/<?php echo $this->app_model->CariFFPengguna();?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->app_model->CariNamaPengguna();?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>images/foto_profil/<?php echo $this->app_model->CariFFPengguna();?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->app_model->CariNamaPengguna();?> - <?php echo $this->session->userdata('DeptName') ; ?>
                  <small>---------------</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="javascript:edit(<?php echo $this->app_model->CariIDPengguna();?>)" class="btn btn-default btn-flat">
                  <i class="fa fa-gears"></i> &nbsp; Setting</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('home/logout');?>" class="btn btn-default btn-flat">
                  <i class="fa fa-power-off"></i> &nbsp; Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li style="background: red;">
            <a href="<?php echo site_url('home/logout');?>" title="Sign Out"><i class="fa fa-power-off"></i></a>
          </li>
          <li style="background: grey;">
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  
<div class="modal fade" id="myModalEditUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><strong>Data User</strong></h4></div><div class="modal-body"><div>
                        

<form class="form-horizontal"  name="formEditUser" id="formEditUser">
<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">UserName</label>
<div class="col-xs-8">
<input type="text" id="username2" name="username2"  class="form-control" readonly="true">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Full Name</label>
<div class="col-xs-8">
<input type="text" id="nama_lengkap2" name="nama_lengkap2"  class="form-control" >
</div></div> 
</div> 


<div class="col-md-6">
   
        
<div class="form-group">
<label class="col-xs-4 control-label">ID</label>
<div class="col-xs-8">
<input type="text" id="RegID2" name="RegID2"  class="form-control" readonly="true">
</div></div>


<div class="form-group">
<label class="col-xs-4 control-label">Password</label>
<div class="col-xs-8">
<input type="password" id="pwd" name="pwd"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Confirm</label>
<div class="col-xs-8">
<input type="password" id="pwd2" name="pwd2"  class="form-control">
</div></div></div></div> </form>
<br /><br /><br />

<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<button type="button" name="SimpanEditUser" id="SimpanEditUser" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
</div>
 
   
    
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Success.png" /> Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan"></div>


    
</div></div></div></div></div><!-- /.modal -->

 <div class="modal fade" id="myModalWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Warning.png" /> Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan4"></div>


    
</div></div></div></div></div><!-- /.modal -->

  <script type="text/javascript">

function edit(id){
    
$("#myModalEditUser").modal('show');

$("#RegID2").val(id);

setTimeout(function(){
					$("#RegID2").focus();
					$("#RegID2").click();
},500)
	
}
</script>


  
    