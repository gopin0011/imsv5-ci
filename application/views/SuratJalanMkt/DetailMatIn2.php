<!-- start DetailMatIn2.view -->

<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Part Name</th>
<th>Specs</th>
<th>Remark</th>
<th>Qty</th>
<th>UoM</th>
<!--<th></th>-->
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $QtyMat =  $row->Quantity ;  
 $CreateID =  $row->CreateByID ;  
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 //$MatNum =  $row->MatNum;
 //$DocNum = md5($row->DocNum) ;
 //$DocNumDetail = $row->DocNumDetail ;
 $StockFG = $this->app_model->CariStockFG($row->ItemID) ;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="200"><?php echo $PartName ; ?></td>
 <td align="left" width="60" ><?php echo $row->JobNumber; ?></td>
 <td align="left" width="60" ><?php echo $row->OrderReference; ?></td>  
 <td align="right" width="20" ><?php echo number_format($QtyMat); ?></td>
 <td align="left" width="60" ><?php echo $row->unit; ?></td>
 <!--
 <td align="center" width="60">
 <a onfocus="PilihEdit('<?php echo $row->RegID ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a> 
 <a onfocus="PilihHapus('<?php echo $row->RegID ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 </td>-->
 </tr>
<?php endforeach;?>
</tbody>
</table>


<div class="panel-footer">

<input type="hidden" value="<?php echo $head->StatusConfirm;?>" name="StatusConfirm" id="StatusConfirm"><input type="hidden" value="<?php echo $from;?>" name="fromModul" id="fromModul">
<!-- button dynamic -->
<?php echo $b_edit;?>
<i class="glyphicon glyphicon-edit"></i>&nbsp; Edit</a>

</div>
<script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>
<script>
    /*
        $(document).ready(function(){
            $('#BEdit').removeAttr('class');
            if($('#StatusConfirm').val() == '1')
            {
                setTimeout(function(){                    
                    //$('#BEdit').attr('class','btn btn-warning disabled');  
                },100); 
            }
            else 
            {
                setTimeout(function(){
                    //$('#BEdit').attr('class','btn btn-warning');  
                },100);
            }
        });
        
     */   
        
        $('#BEdit').click(function(){
            $('#form_tabcontent2').html('');
            if($('#StatusConfirm').val() == '1') return false;
            else
            {
                if(editThisDoc()) waitingDialog3.hide();
                setTimeout(function () 
                {
                    $("#myModal_Search").modal('hide');
                }, 500);
            }
        });
        
        function editThisDoc()
        {
            var hasil = false;
            var time = 100;
            var time2 = 100;
            waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
            //$("#myModal_Search").hide();
            var RegID = $('#RegID').val();
            $('#PartnerID').removeAttr('disabled');
            $('#DlvAddress, #SectionHead, #ShipTime, #DriverName, #CarNum, #Remark').removeAttr('readonly');
            $('#t_list_sj tbody').empty();
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalan/GetData2",
                data	: "RegID="+RegID,
                cache	: false,
                async   : false,
                success	: function(data)
                {
                    var d = JSON.parse(data);
                    var no = 1;
                    
                    //head
                    //alert(d['head'].DocNum);
                    $('#form_tabcontent2').html(d['Templates']);
                    $('#DocDate').val(d['head'].DocDate);
                    $('#DocNum').val(d['head'].DocNum);
                    $('#DocNumDetail').val(d['head'].DocNumDetail);
                    $('#DlvAddress').val(d['head'].DlvAddress);
                    $('#ReleaseDate').val(d['head'].ReleaseDate);
                    $('#PartnerID').val(d['head'].PartnerID);
                    $('#ShipDate').val(d['head'].ShipDate);
                    $('#SectionHead').val(d['head'].SectionHead);
                    $('#CarNum').val(d['head'].CarNum);
                    $('#ShipTime').val(d['head'].ShipTime);
                    $('#DriverName').val(d['head'].DriverName);
                    $('#Remark').val(d['head'].Remark);
                    $('#Username').val(d['head'].Username);
                    $('#PartnerName').val(d['head'].PartnerName);
                    $('#Address').val(d['head'].Address);
                    $('#TH_RegID').val(d['head'].RegID);
                    $('#StatusConfirm').val(d['head'].StatusConfirm);
                    
                    $.each(d['list'],function(i,el){
                        setTimeout(function(){
                            var string = '<tr id="'+el.ItemID+'"><td><span id="no_'+el.ItemID+'"><input type="hidden" value="'+el.ItemID+'" name="list_d[]">'+no+'</span></td><td>'+el.PartName+'</td><td><input type="text" name="JobNumber['+el.ItemID+']" class="form-control" value="'+el.PartNo+'"></td><td><input type="text" name="OrderReference['+el.ItemID+']" class="form-control" value="'+el.OrderReference+'"></td><td><input type="text" name="Quantity['+el.ItemID+']" id="Quantity_'+el.RegID+'" class="form-control" onkeypress="return only_number(event);" value="'+el.Quantity+'"></td><td><span id="s_'+el.ItemID+'"></span></td><td><a onclick="hapus_row(this);" data-id="'+el.ItemID+'" data-toggle="tab" aria-expanded="false" href="javascript:void(0);"><i class="glyphicon glyphicon-trash"></i></td></tr>';
                            $("#t_list_sj tbody").append(string);
                            no++;         
                            
                            var combo = $("<select></select>").attr("name", "IDUnit["+el.ItemID+"]").attr("class","form-control").attr("id", "IDUnit_"+el.ItemID);
                            
                            $.ajax({
                                type	: 'POST',
                                url		: "<?php echo site_url(); ?>/SuratJalan/GetAllUnit",
                                cache	: false,
                                dataType : "json",
                                async   : false,
                                success	: function(d)
                                {
                                    //combo.append($("<option></option>").attr("value", "").text("Pilih"));
                                    $.each(d, function (x,l) {
                                        if(l.id == el.IDUnit)
                                            combo.append($("<option></option>").attr("value", l.id).text(l.unit).prop("selected",x));
                                        else
                                            combo.append($("<option></option>").attr("value", l.id).text(l.unit));
                                    });
                                
                                    $("#s_"+el.ItemID).html(combo);
                                }
                            });
                        },time)
                    time += 100;
                    });
                hasil = true;
                } 
            }).done(function(){
                //alert('tes');                
            });
            return hasil;
        }
        
        
</script>
<!-- end DetailMatIn2.view -->