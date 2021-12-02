<!-- start DetailData.view -->
<form class="form-horizontal"  name="form" id="detailSJ"> 
<table id="t_list_sj" class="table table-bordered table-striped">
<thead>
<tr>
    <td colspan="7"><button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..."><i class="fa  fa-plus"></i>&nbsp; Add</button></td>
</tr>
<tr>
<th>No</th>
<th>Product Name</th>
<th>Specs</th>
<th>Remark</th>
<th>Quantity</th>
<th>UoM</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
</form>
<script>
    $("#tab_tambah_detail").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
    
    function MasterList()
    {
        var kode = "" ;
        $("#MasterList").html("");
        $('#Reload2').button('loading');
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/SuratJalanAll/MasterList",
            data	: "kode="+kode,
            cache	: false,
            success	: function(data)
            {
                setTimeout(function() 
                {
                    $('#Reload2').button('reset'); 
                }, 900);
                setTimeout(function() 
                {
                    $("#MasterList").html(data); 
                }, 700); 
            } 
        });
    }
    
    function hapus_row(obj)
    {
        var id = $(obj).data('id');
        $('#'+id).remove();
        //generate_row();
    }
    
    function generate_row()
    {
        var no = 1;
        if($("#t_list_sj > tbody > tr").length>0)
        {
            $("#t_list_sj > tbody > tr").each(function(e)
            {
                var id = $(this).attr('id');
                $('#no_'+id).html(no);
                no++;
            });
        }
    }
    
    function only_number(e)
    {
        if (e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
			return false;
		}
    }
    
</script>
<!-- end DetailData.view -->