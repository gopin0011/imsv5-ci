<?php
    //echo"<pre>";
    //print_r($header);
    //echo"</pre>";
?>
<form class="form-horizontal"  name="form" id="formSJ">
<input type="hidden" name="RegID" id="RegID" value="<?php echo $header->RegID;?>">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi2"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h5></div>

<div id="transaksi2" class="collapse in">
<div class="panel-body">

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">DocDate</label>
            <div class="col-sm-2">
                <input id="DocDate" type="text" name="DocDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->DocDate;?>">
            </div>
            <label class="control-label col-sm-2">User</label>
            <div class="col-sm-2">
                <input id="Username" type="text" name="Username" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->UserName;?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">DocNum</label>
            <div class="col-sm-2">
                <input id="DocNum" type="text" name="DocNum" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->DocNum;?>">
            </div>
            <label class="control-label col-sm-2">Rev</label>
            <div class="col-sm-2">
                <input id="DocNumDetail" type="text" name="DocNumDetail" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->DocNumDetail;?>">
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
                	<option value="<?php echo $header->PartnerID;?>"><?php echo $header->PartnerCode;?></option>
                </select>
            </div>
            <div class="col-sm-5">
                <input id="PartnerName" type="text" name="PartnerName" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->PartnerName;?>">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Address</label>
            <div class="col-sm-4">
                <textarea id="Address" name="Address" class="form-control" readonly="readonly"><?php echo $header->Address;?></textarea>
            </div>
            <label class="control-label col-sm-2">Dlv Address</label>
            <div class="col-sm-4">
                <textarea id="DlvAddress" name="DlvAddress" class="form-control"><?php echo $header->DlvAddress;?></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Release Date</label>
            <div class="col-sm-2">
                <input id="ReleaseDate" type="text" name="ReleaseDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->ReleaseDate;?>">
            </div>
            <label class="control-label col-sm-2">Ship Date</label>
            <div class="col-sm-2">
                <input id="ShipDate" type="text" name="ShipDate" class="form-control" placeholder="" required="required" data-error="" readonly="readonly" value="<?php echo $header->ShipDate;?>">
            </div>
            <label class="control-label col-sm-2">Car Num</label>
            <div class="col-sm-2">
                <input id="CarNum" type="text" name="CarNum" class="form-control" placeholder="" data-error="" value="<?php echo $header->CarNum;?>">
            </div>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">SectionHead</label>
            <div class="col-sm-2">
                <input id="SectionHead" type="text" name="SectionHead" class="form-control" placeholder="" data-error="" value="<?php echo $header->SectionHead;?>">
            </div>
            <label class="control-label col-sm-2">Ship Time</label>
            <div class="col-sm-2">
                <input id="ShipTime" type="text" name="ShipTime" class="form-control" placeholder="" data-error="" readonly="readonly" value="<?php echo $header->ShipTime;?>">
            </div>  
            <label class="control-label col-sm-2">Driver Name</label>
            <div class="col-sm-2">
                <input id="DriverName" type="text" name="DriverName" class="form-control" placeholder="" data-error="" value="<?php echo $header->DriverName;?>">
            </div>            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label col-sm-2">Remark</label>
            <div class="col-sm-4">
                <textarea id="Remark" name="Remark" class="form-control"><?php echo $header->Remark;?></textarea>
            </div>
        </div>
    </div>
</div>



</div></div></div></div>

</form>

<script>
    $(document).ready(function(){
        //$('#formSJ input').attr('readonly', 'readonly');
        //$('#formSJ select').attr('disabled', 'true');
        $('#PrintList2').attr('data-ref',$('#RegID').val());
    });
</script>
