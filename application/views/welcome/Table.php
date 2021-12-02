<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
    <title>IMS</title>

            
 <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet"> 
  <link href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet"> 
  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="<?php echo base_url(); ?>assets/css/icheck/flat/green.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/floatexamples.css" rel="stylesheet" type="text/css" /> 
  


  <!-- ... -->

  <script type="text/javascript" src="<?php echo base_url(); ?>datetimepicker/jquery.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/nprogress.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/clock.js"></script>

    
    <style>
    body
{
    background: url('<?php echo base_url(); ?>images/login.jpg') fixed;
    background-size: cover;
    padding: 0;
    margin: 0;
}
    
    
    </style>
    
</head>
<body>
<div class="login-page bk-img">
		<div class="form-content">
             <div class="container">    
                <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
                    <div class="panel panel-info" >
                            <div class="panel-heading">
                                <div class="panel-title" style="font-size: larger;">IMS <strong>V5.0</strong></div>
                                <div style="float:right; font-size: 80%; position: relative; top:-10px">ICT Team</div>
                            </div>     
        
                            <div style="padding-top:30px" class="panel-body" >
        
                                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                    
                                <form class="form-horizontal" role="form" action="<?php echo site_url('welcome/proses');?>" method="post" ?>
                                
                                            
                                    <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">Username</span>
                                    <input type="text" class="form-control" id="username" name="username" required="true" placeholder="Username"/>                                   
                                    </div>
                                        
                                    <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon">Password</span>
                                    <input type="password" class="form-control" id="password" name="password" required="true" placeholder="Password"/>
                                    </div>
                                     
                                     <?php echo $this->session->flashdata('message');?></span>
                                            
                                        <div style="margin-top:10px" class="form-group">
                                            <div class="col-sm-12 controls">
                                            <button class="btn btn-success" type="submit" >Login</button>
                                            
                                            </div>
                                        </div>
        
                                        <div class="form-group">
                                            <div class="col-md-12 control">
                                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" class="horizontal">
                                                    <span style="font-family: cursive;">PT SUMMIT ADYAWINSA INDONESIA
                                                    </span><br />
                                                    <span style="font-family: cursive; font-size:90%" >ICT Team @2014 - 2017
                                                    </span>
                                                </div>
                                            </div>
                                        </div>    
                                    </form>     
         </div></div></div></div></div>
    
            
            
           <script src="<?php echo base_url(); ?>assets/css/Login/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/Chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/fileinput.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/chartData.js"></script>
	<script src="<?php echo base_url(); ?>assets/css/Login/js/main.js"></script> 
    
    
    <script src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
  
     <!-- daterangepicker -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>
 
 
  <script>
    NProgress.done();
  </script>   
  
        </body>
        


</html>






