<form class="form-horizontal" id="formSubBomChild">
    <!--<input type="hidden" name="SysIDDetail2a" id="SysIDDetail2a" value="" />-->
    <input type="hidden" id="LinkIDB" name="LinkIDB"  class="form-control" readonly="true">
    <input type="hidden" id="ItemID2B" name="ItemID2B"  class="form-control" readonly="true">
    <input type="hidden" id="ItemNoDetailB" name="ItemNoDetailB"  class="form-control" readonly="true">
    <input type="hidden" min="1" max="20" id="ItemNoDetailSubB" name="ItemNoDetailSubB"  class="form-control">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-success">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#productB"><span class="glyphicon ">
                                </span> Data Parent &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
                                <div id="productB" class="collapse">
                                <div id="detail31B">
                                
                                <div class="panel-body">
                                <div class="col-md-6">
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Item ID</label>
                                <div class="col-lg-8">
                                <input type="text" id="ItemIDSys2B" name="ItemIDSys2"  class="form-control" readonly="">
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No LH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo2B" name="PartNo2"  class="form-control" readonly="readonly">
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No RH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo3B" name="PartNo3"  class="form-control" readonly="readonly">
                                </div></div>
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part Name</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartName2B" name="PartName2"  class="form-control" readonly="readonly">
                                </div>
                                </div> 
                                
                                    <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Packing Type</label>
                                <div class="col-lg-8">
                                <input type="text" id="PackingTypeDetailB" name="PackingTypeDetail"  class="form-control" readonly="readonly">
                                </div></div> 
                                
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Standart Packing</label>
                                <div class="col-lg-8">
                                <input type="text" id="StdPackDetailB" name="StdPackDetail"  class="form-control" readonly="readonly">
                                </div></div>
                                
                                </div>
                                    
                                  <div class="col-md-6">  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Level</label>
                                  <div class="col-lg-8">
                                  <select name="LevelPart" id="LevelPartB" class="form-control" disabled="disabled">
                                  <option value=""></option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>      
                                  </select> </div> </div> 
                                  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Type</label>
                                  <div class="col-lg-8">
                                  <select name="PartTypeID2B" id="PartTypeID2B" class="form-control" disabled="disabled">
                                   <?php
                                    foreach($PartType as $row)
                                    {
                                        echo '<option value="'.$row->SysID.'">'.$row->PartType.'</option>';
                                    }
                                   ?>
                                  </select> </div> </div>
                                  
                                
                                
                                  
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Qty / Car</label>
                                <div class="col-lg-8">
                                <input type="text" id="QtyCarB" name="QtyCar"  class="form-control" readonly="readonly">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Supplier</label>
                                <div class="col-sm-8">
                                <select id="SupplierIDB" name="SupplierIDB" class="form-control" style="width: 100%;" disabled="disabled">
                                <?php
                                    foreach($Partner as $row)
                                    {
                                        echo '<option value="'.$row->id.'">'.$row->partner_name.'</option>';    
                                    }
                                ?>    
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Is RH LH</label>
                                <div class="col-sm-8">
                                <select name="IsRHLHB" id="IsRHLHB" class="form-control" disabled="disabled">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                                </div></div>
                                                                
                                
                            </div></div></div></div></div></div>
                            
                            <div class="panel-group" id="accordionXZ">
                                <div class="panel panel-success">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordionXZ" href="#productXZ"><span class="glyphicon ">
                                </span> Data Child &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
                                <div id="productXZ" class="collapse in">
                                <div id="detail31XZ">
                                
                                <div class="panel-body">
                                <div class="col-md-6">
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Item ID</label>
                                <div class="col-lg-8">
                                <input type="text" id="ItemIDSys2C" name="ItemIDSys2"  class="form-control" readonly="">
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No LH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo2C" name="PartNo2"  class="form-control" >
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No RH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo3C" name="PartNo3"  class="form-control">
                                </div></div>
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part Name</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartName2C" name="PartName2"  class="form-control">
                                </div>
                                </div> 
                                
                                    <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Packing Type</label>
                                <div class="col-lg-8">
                                <input type="text" id="PackingTypeDetailC" name="PackingTypeDetail"  class="form-control">
                                </div></div> 
                                
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Standart Packing</label>
                                <div class="col-lg-8">
                                <input type="text" id="StdPackDetailC" name="StdPackDetail"  class="form-control">
                                </div></div>
                                
                                </div>
                                    
                                  <div class="col-md-6">  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Level</label>
                                  <div class="col-lg-8">
                                  <select name="LevelPart" id="LevelPartC" class="form-control">
                                  <option value=""></option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>      
                                  </select> </div> </div> 
                                  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Type</label>
                                  <div class="col-lg-8">
                                  <select name="PartTypeID2" id="PartTypeID2C" class="form-control">
                                  <option value=""></option>
                                  
                                  </select> </div> </div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Qty / Car</label>
                                <div class="col-lg-8">
                                <input type="text" id="QtyCarC" name="QtyCar"  class="form-control">
                                </div></div>
                                
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Supplier</label>
                                <div class="col-sm-8">
                                <select id="SupplierIDC" name="SupplierID" class="form-control" style="width: 100%;">
                                <option value="0">&nbsp;</option>
                                    <?php
                                        foreach($Partner as $row)
                                        {
                                            echo'<option value="'.$row->id.'">'.$row->partner_name.'</option>';
                                        }
                                    ?>
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Is RH LH</label>
                                <div class="col-sm-8">
                                <select name="IsRHLH" id="IsRHLHC" class="form-control">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                                </div></div>
                                                                
                                
                                </div></div></div></div></div></div>
                                
                                <div class="panel-group" id="accordion3XZ"> 
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion3XZ" href="#MaterialSpecCollapseXZ"><span class="glyphicon ">
                                </span> Material Spec &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
                                
                                <div id="MaterialSpecCollapseXZ" class="collapse">
                                
                                <div class="panel-body" style="background: aqua;">
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Spec Order</label>
                                <div class="col-lg-4">
                                <input type="text" id="SpecOrder1" name="SpecOrder1"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <input type="text" id="SpecOrder2" name="SpecOrder2"  class="form-control">
                                </div></div>
                                
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                 <label class="col-lg-4 control-label">Material Type</label>
                                 <div class="col-lg-8">
                                  
                                <select name="MaterialType" id="MaterialType" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Type</option>
                                </select>
                                
                                  </div> </div> 
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Spec</label>
                                <div class="col-lg-8">
                                <input type="text" id="Spec" name="Spec"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
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
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Qty Part</label>
                                <div class="col-lg-8">
                                <input type="text" id="QtyPart" name="QtyPart"  class="form-control" value="1">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Ratio</label>
                                <div class="col-lg-8">
                                <input type="text" id="Ratio" name="Ratio"  class="form-control" value="1">
                                </div></div>
                                
                                </div>
                                
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Pcs / Sheet</label>
                                <div class="col-lg-8">
                                <input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Kg / Sheet</label>
                                <div class="col-lg-8">
                                <input type="text" id="KgPerSheet" name="KgPerSheet"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part Weight</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartWeight" name="PartWeight"  class="form-control">
                                </div></div>
                                
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-sm-4 control-label">Is Common</label>
                                  <div class="col-sm-8">
                                  <select name="IsCommon" id="IsCommon" class="form-control">
                                 <option value="0">False</option>
                                 <option value="1">True</option>
                                  </select> </div> </div>
                                  
                                </div>
                                </div>
                                </div></div></div>
                                
                                <div class="panel-group" id="accordion4XZ">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion4XZ" href="#ProsesOPXZ"><span class="glyphicon " id="timbul2">
                                </span> Proccess & Home Line &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
                                
                                <div id="ProsesOPXZ" class="collapse">
                                
                                <div class="panel-body">
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP5</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP5" name="OP5"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                
                                <select name="OP5M" id="OP5M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0" >Machine</option>
                                </select>
                                </div></div>
                                  
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP10</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP10" name="OP10"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP10M" id="OP10M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Machine</option>
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP20</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP20" name="OP20"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP20M" id="OP20M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Machine</option>
                                </select>  </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP30</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP30" name="OP30"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP30M" id="OP30M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Machine</option>
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP40</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP40" name="OP40"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP40M" id="OP40M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Machine</option>
                                </select> </div></div>
                                
                                </div>
                                
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP50</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP50" name="OP50"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP50M" id="OP50M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Machine</option>
                                </select> </div></div>
                                
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP60</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP60" name="OP60"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP60M" id="OP60M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                
                                <option value="0">Machine</option>
                                
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP70</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP70" name="OP70"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP70M" id="OP70M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                
                                <option value="0">Machine</option>
                                
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Process Assy</label>
                                <div class="col-lg-4">
                                <input type="text" id="ProcessAssy" name="ProcessAssy"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                
                                <select name="ProcessAssyM" id="ProcessAssyM" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                
                                <option value="0">Machine</option>
                                
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">No.</label>
                                <div class="col-lg-8">
                                <input type="number" min="2" max="20" id="NoUrut" name="NoUrut"  class="form-control">
                                </div></div>
                                
                                </div></div></div></div></div>
                                
                                
                                                               
</form>
<script>
    $("#SupplierIDC").select2();
</script>