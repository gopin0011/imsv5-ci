<head>         
   <link href="<?php echo base_url(); ?>assets/css/table/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url(); ?>assets/css/table/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

  <script src="<?php echo base_url(); ?>assets/js/echart/echarts-all.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/echart/green.js"></script>
  
  <?php
$tahun = date('Y');

for($a=1 ; $a<=12; $a++){
	$total = $this->app_model->CariTotalProduksi($a,$tahun);
	$data[$a]= $total;
}


$tampil_data = '';

for ($i=1; $i<=12; $i++) {

	$tampil_data .= $data[$i];
	if($i < 12) $tampil_data .= ',';
}

?>

  <?php


for($a=1 ; $a<=12; $a++){
	$total = $this->app_model->CariTotalNGProduksi($a,$tahun);
	$data[$a]= $total;
}


$tampil_data_NG = '';

for ($i=1; $i<=12; $i++) {

	$tampil_data_NG .= $data[$i];
	if($i < 12) $tampil_data_NG .= ',';
}

?>

</head>

<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
    
    $("#TutupComment").click(function(){
	$("#myModalCom").modal('hide');
    tampil_data();
	}); 
    
    function reloadAja() {
tampil_data();
} ;
    
    $("#Reload").click(function(){
       tampil_data();
	}); 
	
	tampil_data();
	function tampil_data(){
		var kode = "";
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Comment/DataDetail",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#tampil_data").html(data);
                $("#myModal100").modal('hide');	
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
       NotifProses('Processing...');
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Comment/simpan",
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

<div class="row top_tiles">
<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="animated flipInY col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <div class="tile-stats">
            <div class="count"><em>Welcome</em>, <?php echo $this->app_model->CariNamaPengguna();?></div>
            <h3>Aplikasi ini masih dalam pengembangan</h3>
            <p>ICT Team 2014 ~ 2016</p>
            </div>
            </div>
            <div class="animated flipInY col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div class=""><?php echo $Date ?></div>
            <h3><span id="clock"></span></h3>
            </div>
            
            </div>
</div>

         
<hr />

<div class="clearfix"></div>      
 <div class="row">
 <div class="col-md-12 col-sm-12 col-xs-12">
 <div class="dashboard_graph">
<div class="row x_title">
<div class="col-md-6">
<h3>Forums<small></small></h3>
</div>

<div class="col-md-6">

<div id="reportrange" class="pull-right">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalCom">
 <i class="fa fa-wechat"></i> Comment
</button>
<button type="button" class="btn btn-success" id="Reload">
 <i class="fa fa-refresh"></i> Refresh
</button>

</div>
</div>

</div>

<div class="col-md-12 col-sm-12 col-xs-12" onmouseover="reloadAja()" onmouseout="reloadAja()">
<div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
<div id="tampil_data" onmouseover="reloadAja()" onmouseout="reloadAja()"></div>
</div>
              

              <div class="clearfix"></div>
            </div>
          </div>

        </div>
        
        
<hr />



          





<div class="modal fade" id="myModalCom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content"><div class="modal-body"><div>
                        
<form class="form-horizontal"  name="form" id="form">
<div class="panel-body">
<div class="col-md-12">
<div class="form-group">
</div>

    <div class="form-group">
        <div class="col-lg-12">
            <textarea class="col-lg-12" style="height: 200px;" required="true" name="coment" id="coment" placeholder="Comment"></textarea>
        </div>
    </div>

    
    <div class="panel-footer">
        <button type="reset" name="simpan" id="simpan" class="btn btn-success"><i class="fa fa-send"></i> Send</button>
        <button type="button" name="TutupComment" id="TutupComment" class="btn btn-danger"><i class="fa fa-close"></i> Closed</button> 
    </div>

 
</div></div>
</form>
    
</div></div></div></div></div><!-- /.modal -->

            
            
            <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/css/table/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/css/table/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url(); ?>assets/css/table/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/css/table/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/css/table/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    
    
    <script type="text/javascript">

function pilih(id){
	$("#myModal").modal("hide");
	$("#part_no").val(id);
	$("#part_no").focus();
	
}
</script>

<script type="text/javascript">
     var myChart = echarts.init(document.getElementById('echart_line'), theme);
    myChart.setOption({
      title: {
        text: 'Production Summary',
        subtext: 'Pcs'
      },
      tooltip: {
        trigger: 'axis'
      },
      legend: {
        data: ['Qty OK', 'Qty NG']
      },
      toolbox: {
        show: true,
        feature: {
          magicType: {
            show: true,
            type: ['line', 'bar', 'stack', 'tiled']
          },
          restore: {
            show: true
          },
          saveAsImage: {
            show: true
          }
        }
      },
      calculable: true,
      xAxis: [{
        type: 'category',
        boundaryGap: false,
        data: ['Jan 16', 'Feb 16', 'Mar 16', 'Apr 16', 'May 16', 'Jun 16', 'Jul 16', 'Aug 16', 'Sep 16', 'Oct 16', 'Nov 16', 'Dec 16']
      }],
      yAxis: [{
        type: 'value'
      }],
      series: [{
        name: 'Qty OK',
        type: 'line',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: [<?php echo $tampil_data;?>]
      }, {
        name: 'Qty NG',
        type: 'line',
        smooth: true,
        itemStyle: {
          normal: {
            areaStyle: {
              type: 'default'
            }
          }
        },
        data: [<?php echo $tampil_data_NG;?>]
      }]
    });
  </script>
  
   <script src="<?php echo base_url(); ?>assets/js/echart/echarts-all.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/echart/green.js"></script>

  <script>
    


   
   

    var myChart = echarts.init(document.getElementById('echart_donut'));
    myChart.setOption({
      tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} Item"
      },
      calculable: true,
      legend: {
        //orient: 'vertical',
        //x: 'left',
        x: 'center',
        y: 'bottom',
        data:  ['Danger', 'Warning', 'Safe', 'Coution 1', 'Over']
      },
      toolbox: {
        show: true,
        feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel'],
            option: {
              funnel: {
                x: '25%',
                width: '50%',
                funnelAlign: 'center',
                max: <?php echo $total_cust ;?>
              }
            }
          },
          restore: {
            show: true
          },
          saveAsImage: {
            show: true
          }
        }
      },
      series: [{
        name: 'Material Stock',
        type: 'pie',
        radius: ['35%', '55%'],
        itemStyle: {
          normal: {
            label: {
              show: true
            },
            labelLine: {
              show: true
            }
          },
          emphasis: {
            label: {
              show: true,
              position: 'center',
              textStyle: {
                fontSize: '14',
                fontWeight: 'normal'
              }
            }
          }
        },
        data: [{
          value: <?php echo $danger1 ;?>,
          name: 'Danger'
        }, {
          value: <?php echo $warning1 ;?>,
          name: 'Warning'
        }, {
          value: <?php echo $safe1 ;?>,
          name: 'Safe'
        }, {
          value: <?php echo $warning_up1 ;?>,
          name: 'Coution 1'
        }, {
          value: <?php echo $danger_up1 ;?>,
          name: 'Over'
        }]
      }]
    });

    

    
    
     var myChart = echarts.init(document.getElementById('echart_pie2'));
    myChart.setOption({
      tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} Item"
      },
      legend: {
        x: 'center',
        y: 'bottom',
        data:  ['Danger', 'Warning', 'Safe', 'Coution 1', 'Over']
      },
      toolbox: {
        show: true,
        feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel']
          },
          restore: {
            show: true
          },
          saveAsImage: {
            show: true
          }
        }
      },
      calculable: true,
      series: [{
        name: 'Area Mode',
        type: 'pie',
        radius: [25, 90],
        center: ['50%', 170],
        roseType: 'area',
        x: '50%',
        max: 40,
        sort: 'ascending',
        data: [{
          value: <?php echo $danger12 ;?>,
          name: 'Danger'
        }, {
          value: <?php echo $warning12 ;?>,
          name: 'Warning'
        }, {
          value: <?php echo $safe12 ;?>,
          name: 'Safe'
        }, {
          value: <?php echo $warning_up12 ;?>,
          name: 'Coution 1'
        }, {
          value: <?php echo $danger_up12 ;?>,
          name: 'Over'
        }]
      }]
    });


   

    
  </script>

 <script>
 $('#demo').pagination({
    dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 35],
    pageSize: 5,
    autoHidePrevious: true,
    autoHideNext: true,
    callback: function(data, pagination) {
        // template method of yourself
        var html = template(data);
        dataContainer.html(html);
    }
})
 </script>
  
