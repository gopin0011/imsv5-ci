function viewMaping()
{
    $('ViewB').button('loading');
    $.ajax({
            type        : 'POST',
            url         : Globals.site_url+'/MasterBom/GetListBomBuild',
            cache       : false,
            data        : "LinkID="+linkid,
            success	: function(data){
                $('#ViewB').button('reset');
                var d = JSON.parse(data);
                $.each(d.list, function(index,value){
                    //var string = '<li id="'+value.ItemID+'"><div class="input-group input-group-sm"><input class="form-control" type="text" disabled="" value="'+value.text+'"><span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" onclick="removeListChild(\''+value.ItemID+'\',\''+linkid+'\',\''+value.ItemID+'\');"><i class="glyphicon glyphicon-trash"></i></button></span></div></li>';
                    var string = '<li id="'+value.ItemID+'"><div class="row form-inline"><div class="input-group col-md-12"> <span class="input-group-addon">'+value.PartType+'</span><input type="text" class="form-control" disabled="" value="'+value.text+'" /><input type="hidden" id="MapItemID" name="MapItemID" value="'+value.ItemID+'"><span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" onclick="removeListChild(\''+value.ItemID+'\',\''+value.ItemID+'\');"><i class="glyphicon glyphicon-trash"></i></button></span></div></div></li>';
                    $('#targetChild').append(string);
                });
            }
     });
}



function GetListPart(obj,list,ItemParent)
{
    $.ajax({
         type	: 'POST',
         url	: Globals.site_url+"/MasterBom/search",
         data	: "query="+$(obj).val()+"&ItemID="+list+"&ItemParent="+ItemParent,
         cache	: false,
         success	: function(data){
            $('#left1').html('');
            $('#left1').append('<h5><center><b>List Part</b></center></h5>');
            var d = JSON.parse(data);
            var a = 200;
            $.each(d.list,function(i,x){
                console.log(this);
                var string = '<li data-ref="'+x.ItemID+'">'+x.PartNo+' - '+x.PartName+'</li>';
                $('#left1').append(string);
                a+=200;
            });	
         }
        });
}

function setNewChildMap(ItemID,PartNo,PartName)
{
    var str = '<li data-ref="'+ItemID+'">'+PartNo+' - '+PartName+'</li>';
    if($("#right1 > li").length > 0)
        $("#right1 > li").last().after(str);
    else
        $("#right1 > h5").after(str);
}

function inputChild(obj)
{
    if($(obj).prop("checked") == true)
    {
        addListChild($(obj).val(),$(obj).data('ref'),$(obj).data('itemid'),$(obj).data('parttype'));
    } else 
    {
        removeListChild($(obj).val(),$(obj).data('itemid'));
    }
}

function addListChild(id,text,itemid,parttype)
{
    $.ajax({
        type        : 'POST',
        url         : Globals.site_url+'/MasterBom/InsertBomBuild',
        cache       : false,
        data        : "LinkID="+linkid+"&ItemID="+itemid,
        success	: function(data){
            var d = JSON.parse(data);
            //var string = '<li id="'+id+'"><div class="input-group input-group-sm"><input class="form-control" type="text" disabled="" value="'+text+'"><span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" onclick="removeListChild(\''+id+'\',\''+linkid+'\',\''+itemid+'\');"><i class="glyphicon glyphicon-trash"></i></button></span></div></li>';
            //var string = '<li id="'+itemid+'"><div class="row form-inline"><div class="input-group col-md-12"> <span class="input-group-addon">'+parttype+'</span><input type="text" class="form-control" disabled="" value="'+text+'" /><input type="hidden" id="MapItemID" name="MapItemID" value="'+itemid+'"><span class="input-group-btn"><button class="btn btn-danger btn-flat" type="button" onclick="removeListChild(\''+itemid+'\',\''+linkid+'\',\''+itemid+'\');"><i class="glyphicon glyphicon-trash"></i></button></span></div></div></li>';
            //$('#targetChild').append(string);
            //var ItemNo = '<span class="label label-default">123</span>';
            //var ahref = '<a class="accordion-toggle" style="cursor: pointer;" data-toggle="collapse" data-target="#SAI1700015-3"><i class="glyphicon glyphicon-eye-open"></i></a><a onfocus="PilihEditDetail(\'SAI1700018-10\',\'SAI1700018-10\')" href="#tab_content2" data-toggle="tab" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i></a><a onfocus="PilihHapusDetail(\''+d.list.SysID+'\',\''+d.list.PartNo+'\',\''+d.list.ItemSys+'\')" href="#tab_content2" data-toggle="tab" aria-expanded="false"><i class="glyphicon glyphicon-trash"></i></a>';
            //var str = '<tr id="'+d.list.ItemSys+'"><td width="70" align="center">'+ItemNo+'</td><td width="120" align="left">'+d.list.PartNo+'<input type="hidden" class="detailItem" name="detailItem'+d.list.ItemID+'" value="'+d.list.ItemID+'" /></td><td width="300" align="left">'+d.list.PartName+'</td><td width="60" align="left">'+d.list.Code+'</td><td width="40" align="left">'+d.list.ProjectName+'</td><td width="40" align="left"><span class="label label-info">'+d.list.PartType+'</span></td><td width="30" align="center">'+ahref+'</td></tr>';
            //str += '<tr id="d'+d.list.ItemSys+'"><td colspan="7">tes</td></tr>'
            //$('table#t_transaction_detail2 tbody').append(str);
            DetailBOM88(linkid);
        }
    });
    
}

function DetailBOM88(kode)
{
    //$( "#formaddchild2" ).hide();
	$('#formaddchild').attr('style','display:none');
    var kode = $("#SysIDDetail").val();
	var i = 300;
    $.ajax({
        type	: 'POST',
        url		: Globals.site_url+"/MasterBom/DetailBOM",
        data	: "kode="+kode,
        cache	: false,
        success	: function(data){
			$('#rightside').attr('style','display:none');
			$('#rightside').html(data);
			setTimeout(function(){
				  $('#rightside').removeAttr('style');
				  i += 300;
			},i);
        } 	
    });
    
}

function removeListChild(id,itemid)
{    
    //var obj = document.getElementById("chk"+itemid);
    //$(obj).prop('checked',false);
    $.ajax({
        type        : 'POST',
        url         : Globals.site_url+'/MasterBom/DeleteBomBuild',
        cache       : false,
        data        : "LinkID="+linkid+"&ItemID="+itemid,
        success	: function(data){
            //$('#'+id).remove();
            //$('#chk'+id).prop("checked",false);
            DetailBOM88(linkid);
        }
    });
}


function editthisBOM2(ItemID,option)
{
    //$( "#formaddchild2" ).hide();
    document.getElementById('formSubBom').reset();
    $('#reload12').button('loading');
    $.ajax({
        type        : 'POST',
        url         : Globals.site_url+'/MasterBom/GetInfoChild',
        cache       : false,
        data        : "kode="+$("#SysIDDetail").val()+"&ItemID="+ItemID,
        success	: function(data){
            $('#reload12').button('reset');
            $('#rightside').attr('style','display:none');
            //$('#rightside').html(data);
            var de = JSON.parse(data);
            var d = de.list;
            //$('#rightside').html(d.templates);
            setTimeout(function(){
                //fillFromDB(d.list);
                $('#ItemIDSys2').val(d.ItemID);
                $('#ItemID2').val(d.SysIDA);
                $('#LinkID').val(d.LinkIDA);
                $('#ItemNoDetail').val(d.ItemNo);
                $('#ItemNoDetailSub').val(d.ItemNoSub);
                $('#PartNo2').val(d.PartNo);
                $('#PartNo3').val(d.PartNo2);
                $('#PartName2').val(d.PartName);
                $('#PackingTypeDetail').val(d.PackingType);
                $('#StdPackDetail').val(d.StdPack);
                $('#LevelPart').val(d.LevelPart);
                //$('#PartTypeID2').val(d.PartType);
                set_hide(d.PartType);
                $('#QtyCar').val(d.QtyPerCar);
                $('#SupplierID').val(d.SupplierID).trigger('change');
                $('#IsRHLH').val(d.IsRHLH);
                
                $('#PartTypeID2').find('option').remove();
                
                $('#img_preview').attr({'src':Globals.base_url+'uploads/'+d.Images});
                var list = de.PartTypeRM;
                $.each(list, function(i,x){
                   $('#PartTypeID2').append('<option value="'+x.id+'">'+x.text+'</option>');
                });
                $('#PartTypeID2').val(d.PartType).trigger('change');
                
                var selectedValues = [];
                $.each(de.ItemRM, function(i,x){
                    selectedValues[i]= x.id;
                });
                $('#PartRM').val(selectedValues).trigger('change');
                
                console.log(de.PartChild);
                $('#PartNoMap').val(de.PartChild);
                                
                //material spek
                $('#SpecOrder1').val(d.SpecOrder1);
                $('#SpecOrder2').val(d.SpecOrder2);
                $('#MaterialType').val(d.MaterialType);
                $('#Spec').val(d.Spec);
                $('#Thick').val(d.Thick);
                $('#Width').val(d.Width);
                $('#Length').val(d.Length);
                $('#QtyPart').val(d.QtyPart);
                $('#Ratio').val(d.Ratio);
                $('#PcsPerSheet').val(d.PcsPerSheet);
                $('#KgPerSheet').val(d.KgPerSheet);
                $('#PartWeight').val(d.PartWeight);
                $('#IsCommon').val(d.IsCommon);
                //proses & home line
                $('#OP5').val(d.OP5);
                $('#OP5M').val(d.OP5M);
                $('#OP10').val(d.OP10);
                $('#OP10M').val(d.OP10M);
                $('#OP20').val(d.OP20);
                $('#OP20M').val(d.OP20M);
                $('#OP30').val(d.OP30);
                $('#OP30M').val(d.OP30M);
                $('#OP40').val(d.OP40);
                $('#OP40M').val(d.OP40M);
                $('#OP50').val(d.OP50);
                $('#OP50M').val(d.OP50M);
                $('#OP60').val(d.OP60);
                $('#OP60M').val(d.OP60M);
                $('#OP70').val(d.OP70);
                $('#OP70M').val(d.OP70M);
                $('#ProcessAssy').val(d.ProcessAssy);
                $('#ProcessAssyM').val(d.LineAssy);
                $('#NoUrut').val(d.NoUrut);
                $('#SysIDDetail2a').val(d.LinkIDA);
                $('#formaddchild').removeAttr("style");
                setTimeout(function(){
                    //$("#wrapper").removeAttr('class');
                    if(option!='search')
                        $('#MParts').val(ItemID).trigger('change');	
                },300);                
            },100);
        }
   }); 
}

function fillFromDB(d)
{
    //produk
    $('#ItemIDSys2').val(d.ItemID);
    $('#ItemID2').val(d.SysIDA);
    $('#LinkID').val(d.LinkIDA);
    $('#ItemNoDetail').val(d.ItemNo);
    $('#ItemNoDetailSub').val(d.ItemNoSub);
    $('#PartNo2').val(d.PartNo);
    $('#PartName2').val(d.PartName);
    $('#PackingTypeDetail').val(d.PackingType);
    $('#StdPackDetail').val(d.StdPack);
    $('#LevelPart').val(d.LevelPart);
    $('#PartTypeID2').val(d.PartType);
    $('#QtyCar').val(d.QtyPerCar);
    $('#SupplierID').val(d.SupplierID);
    //material spek
    $('#SpecOrder1').val(d.SpecOrder1);
    $('#SpecOrder2').val(d.SpecOrder2);
    $('#MaterialType').val(d.MaterialType);
    $('#Spec').val(d.Spec);
    $('#Thick').val(d.Thick);
    $('#Width').val(d.Width);
    $('#Length').val(d.Length);
    $('#QtyPart').val(d.QtyPart);
    $('#Ratio').val(d.Ratio);
    $('#PcsPerSheet').val(d.PcsPerSheet);
    $('#KgPerSheet').val(d.KgPerSheet);
    $('#PartWeight').val(d.PartWeight);
    $('#IsCommon').val(d.IsCommon);
    //proses & home line
    $('#OP5').val(d.OP5);
    $('#OP5M').val(d.OP5M);
    $('#OP10').val(d.OP10);
    $('#OP10M').val(d.OP10M);
    $('#OP20').val(d.OP20);
    $('#OP20M').val(d.OP20M);
    $('#OP30').val(d.OP30);
    $('#OP30M').val(d.OP30M);
    $('#OP40').val(d.OP40);
    $('#OP40M').val(d.OP40M);
    $('#OP50').val(d.OP50);
    $('#OP50M').val(d.OP50M);
    $('#OP60').val(d.OP60);
    $('#OP60M').val(d.OP60M);
    $('#OP70').val(d.OP70);
    $('#OP70M').val(d.OP70M);
    $('#ProcessAssy').val(d.ProcessAssy);
    $('#ProcessAssyM').val(d.LineAssy);
    $('#NoUrut').val(d.NoUrut);
    $('#SysIDDetail2a').val(d.LinkIDA);
}

var IDCust = $('#IDCustQ').val();
$('#IDCustS').val(IDCust);

//viewMaping();