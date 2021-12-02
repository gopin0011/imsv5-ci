<!-- start tab_content2.view -->

<form class="form-horizontal"  name="form" id="formSJ">
<input type="hidden" name="TH_RegID" id="TH_RegID" value="" />
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h5></div>

<div id="transaksi" class="collapse in">
<div class="panel-body">

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">DocDate</label>
            <div class="col-sm-2">
                <input id="DocDate" type="text" name="DocDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
            <label class="control-label col-sm-2">User</label>
            <div class="col-sm-2">
                <input id="Username" type="text" name="Username" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">DocNum</label>
            <div class="col-sm-2">
                <input id="DocNum" type="text" name="DocNum" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
            <label class="control-label col-sm-2">Rev</label>
            <div class="col-sm-2">
                <input id="DocNumDetail" type="text" name="Rev" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Customer</label>
            <div class="col-sm-2">
                <select name="PartnerID" id="PartnerID" class="form-control">
                	<option value="">PILIH</option>
                	<?php foreach($Partner as $t){ if($PartnerID==$t->SysID){ ?>
                	<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->PartnerCode;?></option>
                	<?php }else { ?>
                	<option value="<?php echo $t->SysID;?>"><?php echo $t->PartnerCode;?></option>
                	<?php } } ?>  
                </select>
            </div>
            <div class="col-sm-5">
                <input id="PartnerName" type="text" name="PartnerName" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Address</label>
            <div class="col-sm-4">
                <textarea id="Address" name="Address" class="form-control" readonly="readonly"></textarea>
            </div>
            <label class="control-label col-sm-2">Dlv Address</label>
            <div class="col-sm-4">
                <textarea id="DlvAddress" name="DlvAddress" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Release Date</label>
            <div class="col-sm-2">
                <input id="ReleaseDate" type="text" name="ReleaseDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
            <label class="control-label col-sm-2">Ship Date</label>
            <div class="col-sm-2">
                <input id="ShipDate" type="text" name="ShipDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly">
            </div>
            <label class="control-label col-sm-2">Car Num</label>
            <div class="col-sm-2">
                <input id="CarNum" type="text" name="CarNum" class="form-control" placeholder="" data-error="">
            </div>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">SectionHead</label>
            <div class="col-sm-2">
                <input id="SectionHead" type="text" name="SectionHead" class="form-control" placeholder="" data-error="">
            </div>
            <label class="control-label col-sm-2">Ship Time</label>
            <div class="col-sm-2">
                <!--<input type="text" class="form-control" id="ShipTime" name="ShipTime"/>-->
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" id="ShipTime" name="ShipTime" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>  
            <label class="control-label col-sm-2">Driver Name</label>
            <div class="col-sm-2">
                <input id="DriverName" type="text" name="DriverName" class="form-control" placeholder="" data-error="">
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
    $('#ShipDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
    $('#PickupDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
    $('#ReleaseDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
    $('#SJDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    
$(function () {
    $("#PartnerID").select2(); 
$('#datetimepicker3').datetimepicker({
 locale: 'id', format: 'LT' }); });
 
 $('#PartnerID').on('change',function(){
           //alert(this.value);
           if(this.value!="")
           {
               $.ajax({
                    type	: 'POST',
                    url		: "<?php echo site_url(); ?>/SuratJalanWH/GetInfoPartner",
                    data	: "SysID="+this.value,
                    cache	: false,
                    dataType : "json",
                    success	: function(data)
                    {
                        $('#PartnerName').val(data[0].PartnerName);
                        $('#Address').val(data[0].Address); 
                        $('#DlvAddress').val(data[0].Address);   
                    }
               });
           }
           else
           {
            $('#PartnerName').val("");
            $('#Address').val(""); 
            $('#DlvAddress').val("");
           } 
        });
        
</script>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Remark</label>
            <div class="col-sm-4">
                <textarea id="Remark" name="Remark" class="form-control"></textarea>
            </div>
        </div>
    </div>
</div>

</div></div></div></div>

</form>

<!-- end tab_content2.view -->