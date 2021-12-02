<style>
/*!
 * Start Bootstrap - Simple Sidebar (http://startbootstrap.com/)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */

 body {
    overflow-x: hidden;
 }

/* Toggle Styles */

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 300px;
}

#sidebar-wrapper {
    z-index: 1000;    
    left: 300px;
    width: 0;
    height: 100%;
    margin-left: -300px;
    overflow-y: auto;
    background: #000;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 300px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -300px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    width: 300px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 0;
    }

    #wrapper.toggled {
        padding-left: 300px;
    }

    #sidebar-wrapper {
        width: 0;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 300px;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}

#Product{
    overflow: auto;
    height: 450px;
}
#Product p {
    margin-left: 5px;
}



</style>
<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-nav">
                <div class="col-md-12">
                    <div class="row">
                        <form class="form-horizontal" id="FormViewBOM">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Part Level</label>
                                <div class="col-lg-8">
                                    <select id="LevelPartList" class="form-control input-sm" name="LevelPart">
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
                                    <select name="PartTypeIDS" id="PartTypeIDS" class="form-control input-sm" >
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
                                    <input type="text" class="form-control input-sm" id="PartNoS" name="PartNoS" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label">&nbsp;</label>
                                <div class="col-lg-8">
                                <a id="ViewB" class="btn btn-success btn-sm" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">&nbsp;View</a>
                                <a id="NewB" class="btn btn-default btn-sm" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">&nbsp;New</a>
                                
                                </div>
                            </div> 
                        </form>
                    </div>
                    
                    <div class="row">
                        <div id="Product">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="box-body">
        <div class="box">
        <div class="box-body">

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="rightside">
                                <!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <script type="text/javascript">
    
    </script> 

    <script type="text/javascript">
    
    var Globals = <?php echo json_encode(array(
                                                'site_url' => site_url(),
                                                )); 
                      ?>;
    var linkid = $("#SysIDDetail").val();      
              
    $(document).ready(function(){ 
        $('#rightside').html();
        $.ajax({
                type        : 'POST',
                url         : '<?php echo site_url(); ?>/MasterBom/DetailBOM',
                cache       : false,
                data        : "kode="+$("#SysIDDetail").val(),
                success	: function(data){
                    $('#rightside').html(data);
                }
         });
    
    
    
    
});

    $('#ViewB').click(function(){
        $('#ViewB').button('loading');
        $('#list').html('');
        var Arr = [];  
        $.each($('#form_detail input:hidden.detailItem'),function(id,row){
            //if($(this).val()==value.ItemID) { $('#chk'+value.ItemID).prop('checked',true); return true; }
            //else $('#chk'+value.ItemID).prop('checked',false);    
            Arr.push($(this).val());
        }); 
            
        $.ajax({
            type        : 'POST',
            url         : Globals.site_url+'/MasterBom/GetListByPartLevel',
            cache       : false,
            data        : "PartLevel="+$('#LevelPartList').val()+"&PartTypeID="+$('#PartTypeIDS').val()+"&PartNo="+$('#PartNoS').val(),
            success	: function(data){
                $('#ViewB').button('reset');
                var d = JSON.parse(data);
                $.each(d.list, function(index,value){
                    var string = '<p><input id="chk'+value.ItemID+'" type="checkbox" value="'+value.ItemID+'" onclick="inputChild(this,\''+linkid+'\');" data-parttype="'+value.PartType+'" data-itemid="'+value.ItemID+'" data-ref="'+value.PartNo+' - '+value.PartName+'" /> '+value.PartNo+' - '+value.PartName+'&nbsp;&nbsp;<span class="label label-info" style="cursor: pointer;" onclick="editthisBOM2('+value.ItemID+');">edit</span></p>';
                    $('#Product').append(string);
                    if(jQuery.inArray(value.ItemID, Arr) !== -1) $('#chk'+value.ItemID).prop('checked',true);
                });
            }
        });
    });	
    
    $('#NewB').click(function(){
        //$("#wrapper").attr('Class','');  
        $('#formaddchild').attr('display',''); 
        /*                                     
        $.ajax({
            type        : 'POST',
            url         : '<?php echo site_url(); ?>/MasterBom/FormAddItem',
            cache       : false,
            data        : "kode="+$("#SysIDDetail").val(),
            success	: function(data){
                var d = JSON.parse(data);
                $('#rightside').html('');
                //$('#rightside').html(d.templates);
            }
       });
       */
    });
    </script>
    <script src="<?php echo base_url();?>assets/master_bom.js"></script>     