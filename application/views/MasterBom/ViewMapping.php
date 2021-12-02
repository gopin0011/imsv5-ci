<style>

#Product ul {
    list-style-type: none;
    height: 250px;
    overflow: auto;
}

#targetChild
{
    list-style-type: none;
}

#targetChild > li
{
    padding: 5px 0;
}

#DbChild 
{
    height: 430px;
    overflow: auto;
}

</style>
<div class="panel panel-default">
<div class="panel-heading">
</div>
<div class="panel-body">
<div class="row">
<form class="form-horizontal">
    <input type="hidden" name="IDCustQ" id="IDCustQ" value="" />
    <input type="hidden" name="LinkIDQ" id="LinkIDQ" value="" />
    <div class="col-md-6" id="DbChild">
        <ul id="targetChild">
        </ul>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="form-group">
                <label class="col-lg-4 control-label">Part Level</label>
                <div class="col-lg-8">
                    <select id="LevelPartList" class="form-control" name="LevelPart">
                        <option value=""></option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
            </div>
                        
            <div class="form-group">
                <label class="col-lg-4 control-label">Part Type</label>
                <div class="col-lg-8">
                    <select name="PartTypeIDS" id="PartTypeIDS" class="form-control" >
                        <option value=""></option>
                        <?php foreach($PartType->result() as $t){ if($PartTypeID==$t->SysID){ ?>
                        <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
                        <?php }else { ?>
                        <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">Part No</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="PartNoS" name="PartNoS" />
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">&nbsp;</label>
                <div class="col-lg-8">
                <a id="ViewB" class="btn btn-success btn-sm" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">&nbsp;View</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="Product">
                <ul id="list">
                </ul>
            </div>
        </div>
    </div>
    
</form>
</div>
</div>
</div>
<script type="text/javascript">
        var Globals = <?php echo json_encode(array(
                                                'site_url' => site_url(),
                                                )); 
                      ?>;
        var linkid = $('#ItemID').val();      
                  
        $(document).ready(function(){ 
        $('#ViewB').click(function(){
           $('#ViewB').button('loading');
           $('#list').html('');
           var Arr = [];  
           $.each($('#targetChild input[type=hidden]'),function(id,row){
                //if($(this).val()==value.ItemID) { $('#chk'+value.ItemID).prop('checked',true); return true; }
                //else $('#chk'+value.ItemID).prop('checked',false);    
                Arr.push($(this).val());
            });
            
             $.ajax({
                    type        : 'POST',
                    url         : '<?php echo site_url(); ?>/MasterBom/GetListByPartLevel',
                    cache       : false,
                    data        : "PartLevel="+$('#LevelPartList').val()+"&PartTypeID="+$('#PartTypeIDS').val()+"&PartNo="+$('#PartNoS').val(),
                    success	: function(data){
                        $('#ViewB').button('reset');
                        var d = JSON.parse(data);
                        $.each(d.list, function(index,value){
                            var string = '<li><label><input id="chk'+value.ItemID+'" type="checkbox" value="'+value.ItemID+'" onclick="inputChild(this,\''+linkid+'\');" data-parttype="'+value.PartType+'" data-itemid="'+value.ItemID+'" data-ref="'+value.PartNo+' - '+value.PartName+'" /> '+value.PartNo+' - '+value.PartName+'</label></li>';
                            $('#list').append(string);
                            if(jQuery.inArray(value.ItemID, Arr) !== -1) $('#chk'+value.ItemID).prop('checked',true);
                        });
                    }
             });
        });
        
    });
</script>
<script src="<?php echo base_url();?>assets/master_bom.js"></script> 