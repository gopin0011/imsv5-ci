
<div class="col-md-8">
<div class="box">
<div class="box-body">

<table id="t_list_master" class="table table-condensed">
<thead>
<tr>
 <th>No</th>
 <th>Part No</th>
 <th>Part Name</th>
 <th>Qty</th>
 <th>Need/Day (Pcs)</th>
 <th>Stock Strength (day)</th>
</tr>
</thead><tbody>
<?php
 if($num>0){
 $no=0; foreach($list as $db): 
 $no++; 
 $cust = $db->Code  ;
 $StockFG = $db->StockFG  ;                
 $PcsPerDay = $db->PcsPerday  ;
        
 if($PcsPerDay == 0 ) {
 $StockDay = 0 ;            
 }else{
 $StockDay = $StockFG / $PcsPerDay ;  } ;
 $input          = $StockDay * 10;
 $input3          = number_format($StockDay,2);
 $hari = $StockDay ;
        
 if($hari<1){
 $PartNo="<td style=\"color: red ;font-weight: bold;\">". substr($db->PartNo , 0, 15)."</td>"; }
 if($hari>=1 && $hari<3){
 $PartNo="<td style=\"color: black ;\">". substr($db->PartNo , 0, 15)."</td>"; }
 if($hari>=3 && $hari<7){
 $PartNo="<td style=\"color: black ;\">". substr($db->PartNo , 0, 15)."</td>"; }
 if($hari>7 && $hari<=10){
 $PartNo="<td style=\"color: black ;\">". substr($db->PartNo , 0, 15)."</td>"; }
 if($hari>10){
 $PartNo="<td style=\"color: black ;\">". substr($db->PartNo , 0, 15)."</td>"; }
 if($hari<1){
 $bar="<div class=\"progress progress-danger progress-striped active\" atyle=\"background-color: rgb(0, 0, 0);\" data-percent=\"". $input3."\">
 <div class=\"progress-bar progress-bar-danger\" style=\"width: ".$input."%;\"></div></div>"; }
 if($hari>=1 && $hari<3){
 $bar="<div class=\"progress progress-warning progress-striped active\" data-percent=\"". $input3."\">
 <div class=\"progress-bar progress-bar-warning\" style=\"width: ".$input."%;\"></div></div>"; }
 if($hari>=3 && $hari<7){
 $bar="<div class=\"progress progress-warning progress-striped active\" data-percent=\"". $input3."\">
 <div class=\"progress-bar progress-bar-success\" style=\"width: ".$input."%;\"></div></div>"; }
												
 if($hari>7 && $hari<=10){
 $bar="<div class=\"progress progress-warning progress-striped active\" data-percent=\"". $input3."\">
 <div class=\"progress-bar progress-bar-warning-up\" style=\"width: ".$input."%;\"></div></div>"; }
												
 if($hari>10){
 $bar="<div class=\"progress progress-danger progress-striped active\" data-percent=\"". $input3."\">
 <div class=\"progress-bar progress-bar-danger-up\" style=\"width: ".$input."%;\"></div></div>"; }
 ?>  
  
<tr>
 <td><?php echo $no ; ?></td>
 <?php echo $PartNo ; ?>
 <td align="left"><?php echo $db->PartName  ; ?></td>
 <td><span><?php echo number_format($StockFG) ; ?></span></td>
 <td><?php echo $PcsPerDay ; ?> </td>
 <td><?php echo $bar ; ?> </td>
</tr>                                              
<?php endforeach;?>
<?php }else{ ?>
<tr><td colspan="11" align="center" >Tidak Ada Data</td></tr>
<?php } ?>
</tbody>
</table>

</div></div></div>

<div class="col-md-4">
 <div class="box">
 <div class="box-body">
 <div class="row">
 <div class="col-md-12">
 <div class="chart-responsive">
 <canvas id="pieChart" height="250"></canvas>
 </div></div></div></div></div>
                
 <div class="box">
 <div class="box-body">
 <table class="table table-condensed">
 <tr><td><?php echo $danger_legenda ; ?></td>
 <td width="50%">
 <div class="progress progress-danger active" data-percent="DANGER">
 <div class="progress-bar progress-bar-danger" style="width: 100%"></div></div></td>
 <td align="right"><?php echo number_format($danger,2) ;?> %</td>
 <td align="right"><?php echo $danger1 ;?></td>
 </tr>
 <tr>
 <td><?php echo $warning_legenda ; ?></td>
 <td width="50%">
 <div class="progress progress-danger active" data-percent="WARNING">
 <div class="progress-bar progress-bar-warning" style="width: 100%"></div>
 </div>
 </td>
 <td align="right"><?php echo number_format($warning,2) ;?> %</td>
 <td align="right"><?php echo $warning1 ;?></td>
 </tr>
 <tr>
 <td><?php echo $safe_legenda ; ?></td>
 <td width="50%">
 <div class="progress progress-danger active" data-percent="SAFE">
 <div class="progress-bar progress-bar-success" style="width: 100%"></div>
 </div></td>
 <td align="right"><?php echo number_format($safe,2) ;?> %</td>
 <td align="right"><?php echo $safe1 ;?></td>
 </tr>
 <tr>
 <td><?php echo $warning_up_legenda ; ?></td>
 <td width="50%">
 <div class="progress progress-danger active" data-percent="CAUTION 1">
 <div class="progress-bar progress-bar-warning-up" style="width: 100%"></div>
 </div>
 </td>
 <td align="right"><?php echo number_format($warning_up,2) ;?> %</td>
 <td align="right"><?php echo $warning_up1 ;?></td>
 </tr>
 <tr>
 <td><?php echo $danger_up_legenda ; ?></td>
 <td width="50%">
 <div class="progress progress-danger active" data-percent="CAUTION 2">
 <div class="progress-bar progress-bar-danger-up" style="width: 100%"></div>
 </div>
 </td>
 <td align="right"><?php echo number_format($danger_up,2) ;?> %</td>
 <td align="right"><?php echo $danger_up1 ;?></td>
 </tr>
 </table>
 </div>
 
 <input hidden="" type="text" id="danger" >
 <input hidden="" type="text" id="warning" >
 <input hidden="" type="text" id="safe" >
 <input hidden="" type="text" id="warning_up" >
 <input hidden="" type="text" id="danger_up" >
 
 </div></div>

<script>
function Data_Chart(){
 var id = $("#CustIDView").val() ;    
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MonitoringStockFG/ListProduct2",
 data	: "id="+id,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#danger").val(data.danger);
 $("#warning").val(data.warning);
 $("#safe").val(data.safe);
 $("#warning_up").val(data.warning_up);
 $("#danger_up").val(data.danger_up);
 

  ChartBro();
 
}  });  };  

function ChartBro() {
 var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
 var pieChart = new Chart(pieChartCanvas);
 var danger = $("#danger").val();
 var warning = $("#warning").val();
 var safe = $("#safe").val();
 var warning_up = $("#warning_up").val();
 var danger_up = $("#danger_up").val();
        
        var PieData = [
          {
            value: danger,
            color: "RED",
            highlight: "RED",
            label: "Danger"
          },
          {
            value: warning,
            color: "yellow",
            highlight: "yellow",
            label: "Warning"
          },
          {
            value: safe,
            color: "#228B22",
            highlight: "#228B22",
            label: "Safe"
          },
          {
            value: warning_up,
            color: "darkorange",
            highlight: "darkorange",
            label: "Warning"
          },
          {
            value: danger_up,
            color: "#FF00FF",
            highlight: "#FF00FF",
            label: "Over"
          }
        ];
        
 var pieOptions = {
 segmentShowStroke: true,
 segmentStrokeColor: "#fff",
 segmentStrokeWidth: 2,
 percentageInnerCutout: 50, // This is 0 for Pie charts
 animationSteps: 100,
 animationEasing: "easeOutBounce",
 animateRotate: true,
 animateScale: false,
 responsive: true,
 maintainASpec2tRatio: false,
 legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
 };
 pieChart.Doughnut(PieData, pieOptions);
 var barChartCanvas = $("#barChart").get(0).getContext("2d");
 var barChart = new Chart(barChartCanvas);
 var barChartData = areaChartData;
 barChartData.datasets[1].fillColor = "#00a65a";
 barChartData.datasets[1].strokeColor = "#00a65a";
 barChartData.datasets[1].pointColor = "#00a65a";
 var barChartOptions = {
 scaleBeginAtZero: true,
 scaleShowGridLines: true,
 scaleGridLineColor: "rgba(0,0,0,.05)",
 scaleGridLineWidth: 1,
 scaleShowHorizontalLines: true,
 scaleShowVerticalLines: true,
 barShowStroke: true,
 barStrokeWidth: 2,
 barValueSpacing: 5,
 barDatasetSpacing: 1,
 legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
 responsive: true,
 maintainASpec2tRatio: false
 };
 barChartOptions.datasetFill = false;
 barChart.Bar(barChartData, barChartOptions);
 };
 
</script>                
<script>


      
 function labelFormatter(label, series) {
 return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
 + label
 + "<br/>"
 + Math.round(series.percent) + "%</div>";
 }
 </script>
 
 <script> $(function () { $("#t_list_master").DataTable(); });</script>