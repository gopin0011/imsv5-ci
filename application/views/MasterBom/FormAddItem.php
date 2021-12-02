

<form class="form-horizontal" id="formSubBom">
<!--<input type="hidden" name="SysIDDetail2a" id="SysIDDetail2a" value="" />-->
<input type="hidden" id="LinkID" name="LinkID"  class="form-control" readonly="true">
<input type="hidden" id="ItemID2" name="ItemID2"  class="form-control" readonly="true">
<input type="hidden" id="ItemNoDetail" name="ItemNoDetail"  class="form-control" readonly="true">
<input type="hidden" min="1" max="20" id="ItemNoDetailSub" name="ItemNoDetailSub"  class="form-control">
<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="product" class="collapse in">
<div id="detail">

<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Item ID</label>
<div class="col-lg-8">
<input type="text" id="ItemIDSys2" name="ItemIDSys2"  class="form-control" readonly="">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-8">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartName2" name="PartName2"  class="form-control">
</div>
</div> 

    <div class="form-group">
<label class="col-lg-4 control-label">Packing Type</label>
<div class="col-lg-8">
<input type="text" id="PackingTypeDetail" name="PackingTypeDetail"  class="form-control">
</div></div> 

 <div class="form-group">
<label class="col-lg-4 control-label">Standart Packing</label>
<div class="col-lg-8">
<input type="text" id="StdPackDetail" name="StdPackDetail"  class="form-control">
</div></div>

</div>
    
  <div class="col-md-6">  
  <div class="form-group">
  <label class="col-lg-4 control-label">Part Level</label>
  <div class="col-lg-8">
  <select name="LevelPart" id="LevelPart" class="form-control">
  <option value=""></option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>      
  </select> </div> </div> 
  
  <div class="form-group">
  <label class="col-lg-4 control-label">Part Type</label>
  <div class="col-lg-8">
  <select name="PartTypeID2" id="PartTypeID2" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
  <option value=""></option>
  <?php foreach($PartType->result() as $t){ if($PartTypeID==$t->SysID){ ?>
  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
  <?php }else { ?>
  <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
  </select> </div> </div>
  


  
<div class="form-group">
<label class="col-lg-4 control-label">Qty / Car</label>
<div class="col-lg-8">
<input type="text" id="QtyCar" name="QtyCar"  class="form-control">
</div></div> 


<div class="form-group">
<label class="col-xs-4 control-label">Supplier</label>
<div class="col-xs-8">
<select id="SupplierID" name="SupplierID" class="form-control" style="width: 100%;">
<?php if(empty($PartnerID)){ ?>
<option value="0">Select</option>
<?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
<option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
<?php }else { ?>
<option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
<?php } } ?>  
</select>
</div></div>

</div></div></div></div></div></div>


<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#MaterialSpecCollapse"><span class="glyphicon ">
</span> Material Spec &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="MaterialSpecCollapse" class="collapse">

<div class="panel-body" style="background: aqua;">
<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">Spec Order</label>
<div class="col-lg-4">
<input type="text" id="SpecOrder1" name="SpecOrder1"  class="form-control">
</div>
<div class="col-lg-4">
<input type="text" id="SpecOrder2" name="SpecOrder2"  class="form-control">
</div></div>

 <div class="form-group">
 <label class="col-lg-4 control-label">Material Type</label>
 <div class="col-lg-8">
  
  <select name="MaterialType" id="MaterialType" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<option value="0">Type</option>
<?php foreach($MaterialTypeList->result() as $t){ if($MaterialType==$t->MaterialName){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->MaterialName;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->MaterialName;?></option>
<?php } } ?> 
</select>

  </div> </div> 

<div class="form-group">
<label class="col-lg-4 control-label">Spec</label>
<div class="col-lg-8">
<input type="text" id="Spec" name="Spec"  class="form-control">
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Size</label>
<div class="col-lg-2">
<input type="text" id="Thick" name="Thick"  class="form-control" placeholder="T">
</div>
<label class="col-lg-1 control-label">X</label>
<div class="col-lg-2">
<input type="text" id="Width" name="Width"  class="form-control" placeholder="W">
</div>
<label class="col-lg-1 control-label">X</label>
<div class="col-lg-2">
<input type="text" id="Length" name="Length"  class="form-control" placeholder="L">
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Qty Part</label>
<div class="col-lg-8">
<input type="text" id="QtyPart" name="QtyPart"  class="form-control" value="1">
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Ratio</label>
<div class="col-lg-8">
<input type="text" id="Ratio" name="Ratio"  class="form-control" value="1">
</div></div>

</div>

<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">Pcs / Sheet</label>
<div class="col-lg-8">
<input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control">
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Kg / Sheet</label>
<div class="col-lg-8">
<input type="text" id="KgPerSheet" name="KgPerSheet"  class="form-control">
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Part Weight</label>
<div class="col-lg-8">
<input type="text" id="PartWeight" name="PartWeight"  class="form-control">
</div></div>

  <div class="form-group">
  <label class="col-xs-4 control-label">Is Common</label>
  <div class="col-xs-8">
  <select name="IsCommon" id="IsCommon" class="form-control">
 <option value="0">False</option>
 <option value="1">True</option>
  </select> </div> </div>
  
</div>
</div>
</div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#ProsesOP"><span class="glyphicon ">
</span> Proccess & Home Line &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="ProsesOP" class="collapse">

<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">OP5</label>
<div class="col-lg-4">
<input type="text" id="OP5" name="OP5"  class="form-control">
</div>
<div class="col-lg-4">

<select name="OP5M" id="OP5M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP5M)){ ?>
<option value="0" >Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP5M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select>
</div></div>
  
<div class="form-group">
<label class="col-lg-4 control-label">OP10</label>
<div class="col-lg-4">
<input type="text" id="OP10" name="OP10"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP10M" id="OP10M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP10M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP10M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>

<div class="form-group">
<label class="col-lg-4 control-label">OP20</label>
<div class="col-lg-4">
<input type="text" id="OP20" name="OP20"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP20M" id="OP20M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP20M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP20M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select>  </div></div>

<div class="form-group">
<label class="col-lg-4 control-label">OP30</label>
<div class="col-lg-4">
<input type="text" id="OP30" name="OP30"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP30M" id="OP30M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP30M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP30M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>

<div class="form-group">
<label class="col-lg-4 control-label">OP40</label>
<div class="col-lg-4">
<input type="text" id="OP40" name="OP40"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP40M" id="OP40M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP40M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP40M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>

</div>

<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">OP50</label>
<div class="col-lg-4">
<input type="text" id="OP50" name="OP50"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP50M" id="OP50M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP50M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP50M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>


<div class="form-group">
<label class="col-lg-4 control-label">OP60</label>
<div class="col-lg-4">
<input type="text" id="OP60" name="OP60"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP60M" id="OP60M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP60M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP60M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>

<div class="form-group">
<label class="col-lg-4 control-label">OP70</label>
<div class="col-lg-4">
<input type="text" id="OP70" name="OP70"  class="form-control">
</div>
<div class="col-lg-4">
<select name="OP70M" id="OP70M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($OP70M)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($OP70M==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select> </div></div>

<div class="form-group">
<label class="col-lg-4 control-label">Process Assy</label>
<div class="col-lg-4">
<input type="text" id="ProcessAssy" name="ProcessAssy"  class="form-control">
</div>
<div class="col-lg-4">

<select name="ProcessAssyM" id="ProcessAssyM" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
<?php if(empty($ProcessAssy2)){ ?>
<option value="0">Machine</option>
<?php } foreach($Machine->result() as $t){ if($ProcessAssy2==$t->RegID){ ?>
<option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
<?php } } ?> 
</select>
</div></div>

<div class="form-group">
<label class="col-lg-4 control-label">No.</label>
<div class="col-lg-8">
<input type="number" min="2" max="20" id="NoUrut" name="NoUrut"  class="form-control">
</div></div>

</div></div></div></div></div>


<div class="box-body panel-footer">
<div class="box-tools pull-left" data-toggle="tooltip" data-original-title="" title="">
<div class="btn-group" data-toggle="btn-toggle">
<button id="simpan2" class="btn btn-warning" type="button" name="simpan">
<i class="fa fa-save"></i>
Save
</button>
<a id="BAddBack" class="btn btn-success">
<i class="fa fa-mail-reply"></i>
Closed
</a>
<script type="text/javascript">
    $('#BAddBack').click(function(){
        var kode = $("#SysIDDetail").val() ;
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/MasterBom/DetailBOM",
            data	: "kode="+kode,
            cache	: false,
            success	: function(data){
                $('#rightside').attr('style','display:none');
                $("#rightside").html(data);
                //waitingDialog3.hide();
                setTimeout(function(){
                    $('#rightside').attr('style','display:');
                },300);
            }
        });
    });
    
    $('#simpan2').click(function(){
        var kode = $("#SysIDDetail").val();
        var ItemID = $('#ItemIDSys2').val();
        var ItemNo = $("#ItemNo").val();
        var NoUrut = $("#NoUrut").val();
        var ItemNoDetail = $("#ItemNoDetail").val();
        var ItemNoDetailSub = $("#ItemNoDetailSub").val();
        //var LinkID = $("#LinkID").val();
        var LinkID = kode;
        var PartNo2 = $("#PartNo2").val();
        var PartName2 = $("#PartName2").val();
        var PartTypeID2 = $("#PartTypeID2").val();
        var PackingTypeDetail = $("#PackingTypeDetail").val();
        var StdPackDetail = $("#StdPackDetail").val();
        var LevelPart = $("#LevelPart").val();
        var QtyCar = $("#QtyCar").val();
        var SupplierID = $("#SupplierID").val();
        
        var MaterialType = $("#MaterialType").val();
        var IsCommon = $("#IsCommon").val();
        var Spec = $("#Spec").val();
        var QtyPart = $("#QtyPart").val();
        var Ratio = $("#Ratio").val();
        var SpecOrder1 = $("#SpecOrder1").val();
        var SpecOrder2 = $("#SpecOrder2").val();
        var Thick = $("#Thick").val();
        var Width = $("#Width").val();
        var Length = $("#Length").val();
        var PcsPerSheet = $("#PcsPerSheet").val();
        var KgPerSheet = $("#KgPerSheet").val();
        var PartWeight = $("#PartWeight").val();
        var OP5 = $("#OP5").val(); var OP5M = $("#OP5M").val();
        var OP10 = $("#OP10").val(); var OP10M = $("#OP10M").val();
        var OP40 = $("#OP40").val(); var OP40M = $("#OP40M").val();
        var OP20 = $("#OP20").val(); var OP20M = $("#OP20M").val();
        var OP50 = $("#OP50").val(); var OP50M = $("#OP50M").val();
        var OP30 = $("#OP30").val(); var OP30M = $("#OP30M").val();
        var OP60 = $("#OP60").val(); var OP60M = $("#OP60M").val();
        var OP70 = $("#OP70").val(); var OP70M = $("#OP70M").val();
        var ProcessAssy = $("#ProcessAssy").val(); var ProcessAssyM = $("#ProcessAssyM").val();
        
        
        if(PartNo2.length==0){
            $("#myModal4").modal('show');
            $("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
            return false();
        } 
        
        if(PartName2.length==0){
            $("#myModal4").modal('show');
            $("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
            return false();
        } 
        
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild",
            data	: "&ItemID="+ItemID+"&kode="+kode+"&PartNo2="+PartNo2+"&PartName2="+PartName2+"&PartTypeID2="+PartTypeID2+"&LevelPart="+LevelPart+"&QtyCar="+QtyCar+"&SupplierID="+SupplierID+"&MaterialType="+MaterialType+"&Spec="+Spec+"&Thick="+Thick+"&Width="+Width+"&Length="+Length+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&PartWeight="+PartWeight+"&OP5="+OP5+"&OP5M="+OP5M+"&OP10="+OP10+"&OP10M="+OP10M+"&OP40="+OP40+"&OP40M="+OP40M+"&OP20="+OP20+"&OP20M="+OP20M+"&OP50="+OP50+"&OP50M="+OP50M+"&OP30="+OP30+"&OP30M="+OP30M+"&OP60="+OP60+"&OP60M="+OP60M+"&ProcessAssy="+ProcessAssy+"&ProcessAssyM="+ProcessAssyM+"&OP70="+OP70+"&OP70M="+OP70M+"&LinkID="+LinkID+"&PackingTypeDetail="+PackingTypeDetail+"&StdPackDetail="+StdPackDetail+"&ItemNoDetail="+ItemNoDetail+"&ItemNoDetailSub="+ItemNoDetailSub+"&ItemNo="+ItemNo+"&NoUrut="+NoUrut+"&SpecOrder1="+SpecOrder1+"&SpecOrder2="+SpecOrder2+"&IsCommon="+IsCommon+"&QtyPart="+QtyPart+"&Ratio="+Ratio,
            cache	: false,
            dataType : "json",
            success	: function(data){
                //var d = JSON.parse(data);
                NotifSuccsess(data.pesan);
                setTimeout(function(){
                    //$("#detail").show(); 
                    //DetailBOM2(); 
                },1000);
            }  
        });
        var string = $('#formSubBom').serialize();
    });
</script>
</div>
</div>
</div>
</form>