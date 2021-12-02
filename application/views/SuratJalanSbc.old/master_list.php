<!-- master_list.view -->

<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Unit</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="50" ><?php echo $row->unit ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script type="text/javascript"> 
function pilih(id){
 $("#myModal_product").modal('hide');
 $("#ItemID").val(id);
 
        
 var json = [       
     { "id": "pune", "unit": "Pune"  },
     { "id": "mumbai", "unit": "Mumbai"  },
     { "id": "nashik", "unit": "Nashik"  }
   ];
             
 $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/ref_json/GetInfoItem",
        data	: "RegID="+id,
        cache	: false,
        dataType : "json",
        success	: function(data)
        {
            var no = $("#t_list_sj > tbody > tr").length+1;
            var string = '<tr id="'+data[0].RegID+'"><td><span id="no_'+data[0].RegID+'"><input type="hidden" value="'+data[0].RegID+'" name="list_d[]">'+no+'</span></td><td>'+data[0].PartName+'</td><td><input type="text" name="JobNumber['+data[0].RegID+']" class="form-control" value="'+data[0].PartNo+'"></td><td><input type="text" name="OrderReference['+data[0].RegID+']" class="form-control"></td><td><input type="text" name="Quantity['+data[0].RegID+']" id="Quantity_'+data[0].RegID+'" class="form-control" onkeypress="return only_number(event);"></td><td><span id="s_'+data[0].RegID+'"></span></td><td><a onclick="hapus_row(this);" data-id="'+data[0].RegID+'" href="javascript:void(0);" data-toggle="tab" aria-expanded="false"><i class="glyphicon glyphicon-trash"></i></td></tr>';
            var ada = 0;
            $("#PartNo").val(data[0].PartNo);
            $("#PartName").val(data[0].PartName);
            //$("#CustName").val(data[0].CustName);
            $("#t_list_sj > tbody > tr").each(function(e){
               if($(this).attr('id') == data[0].RegID)
               {
                    alert('Item Sudah Ada'); 
                    ada = 1; 
                    return false;
               } 
            });
            if(ada < 1){
                $("#t_list_sj tbody").append(string);
                //getDropDownList("tes",data[0].RegID,arr);
                var combo = $("<select></select>").attr("name", "IDUnit["+data[0].RegID+"]").attr("class","form-control").attr("id", "IDUnit_"+data[0].RegID);
                $.ajax({
                    type	: 'POST',
                    url		: "<?php echo site_url(); ?>/SuratJalanSbc/GetAllUnit",
                    cache	: false,
                    dataType : "json",
                    success	: function(d)
                    {
                        combo.append($("<option></option>").attr("value", "").text("Pilih"));
                        $.each(d, function (x,el) {
                            if(el.id == data[0].IDUnitDefault)
                                combo.append($("<option></option>").attr("value", el.id).text(el.unit).prop("selected",x));
                            else
                                combo.append($("<option></option>").attr("value", el.id).text(el.unit));
                        });
                        $("#s_"+data[0].RegID).html(combo);
                    }
                });
            }
        }
 });
 $("#ItemID").focus(); }
 
 function getDropDownList(name, i, optionList) {
    var combo = $("<select></select>").attr("id", i).attr("name", name);
    
    $.each(optionList, function (x, el) {        
    //    combo.append("<option>" + el.id + "</option>");
        combo.append($("<option></option>").attr("value", el.id).text(el.unit));
    });
    

    //return combo;
    // OR
    //alert(combo);
    $("#s_"+i).html(combo);
}

</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>

<!-- master_list.view -->