<!-- start PrintListNew.view -->
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;margin:0px auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#00000;background-color:lightblue;}
.tg .tg-a2cf{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-lntm{font-weight:bold;font-size:36px;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-l77s{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-h31u{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-h31u1{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top;text-align:left}
.tg .tg-h31u12{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top;text-align:right}
.tg .tg-8fc1{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-efv9{font-family:Arial, Helvetica, sans-serif !important;}
.pagebreak {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
width:100% ;
font-size:13px;
}
.page {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
font-size:12px;
padding:10px;
text-align:center;
width: 1444px ;

}

table, td, th {
    border: 1px solid black;
    padding:  3px 0px 3px 3px;
    font-size: 11px;
}

tbody 
{
    font-size: 10px;
    font-weight: bold;
}
span {
    font-size: smaller;
}
</style>

<?php
    function myheader($kanan)
    {
        echo '<div style="border-style: solid;">';
        echo '<table width="100%" style="padding:5px 5px 5px 5px;" align="center" cellpadding="0" cellspacing="1">';
        echo $kanan;
        echo '<tbody>';
    }
    
    function myfooter()
    {	
        echo "</tbody>";
    	echo "</table>";
        echo "</div>";
    }
        
    if($num>0)
    {
        $kanan = '<thead>
            <tr>
                <th colspan="2" rowspan="3"><img src="'.base_url().'assets/images/adw.png" width="250" height="59"></th>
                <th colspan="6" rowspan="2"><h2>BUKTI PENYERAHAN PART</h2></th>
                <th colspan="3" style="background-color: #ccc;">No. Urut Dokumen</th>
            </tr>
            <tr>
                <th colspan="3" rowspan="2"><img src="'.site_url().'/BPFG/bikin_barcode/'.$DocNum.'" style="width: 135px;"></th>
            </tr>
            <tr>
                <th colspan="6" align="left"><div style="float: left; width: 45%;">DIBUAT OLEH: '.$UserName.'</div></th>
            </tr>
            <tr>
                <td colspan="5"><strong>Hari & Tanggal:</strong>'.$DocDate.'</td>
                <td colspan="6"><strong>Shift:</strong></td>
            </tr>
            <tr>
                <th>NO</th>
                <th>PART</th>
                <th>CUST</th>
                <th>QTY<br /><i><span>(Pcs)</span></i></i></th>
                <th colspan="2">DISERAHKAN<br /><i><span>(TTD & Nama Jelas)</span></i></i></th>
                <th colspan="3">DITERIMA<br /><i><span>(TTD & Nama Jelas)</span></i></i></th>
                <th>KETERANGAN<br /><span><i>(Remark)</i></span></th>
            </tr>
        </thead>';
    
    //$no = 0;
    $g_total=0;
    $no=1;
    $page =1;
    
    foreach($data as $row) {
        
        
        if(($no%7) == 1){
            if($no > 1){
                $ofPage = ceil(($num) / 7);
                myfooter();
                echo "<div class=\"pagebreak\" align='right'>
                <div align='center'>Page $page of $ofPage</div>
                </div>";
                $page++;
            } 
            myheader($kanan);
        }
        
        echo '<tr>
                <td align ="center" width="1%">'.$no.'</td>
                <td width="7%">'.$row->PartNo.'<br/>'.$row->PartName.'</td>
                <td align="center" width="9%">'.$row->Code.'</td>
                <td align="center">'.$row->QtyMat.'</td>
                <td>&nbsp;</td>
                <td width="9%">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td width="9%">&nbsp;</td>
                <td>'.$row->Remark.'</td>
              </tr>';
              
        $g_total = $g_total;
        $ofPage = ceil(($num) / 7);      
        $no++;
        }
        
        echo "";
        echo "";
        myfooter();
        //echo "</table>";	
        echo "<div align='center'>Page ".$page." of ".$ofPage."</div>";
    }
    else
    {
        echo '<center><h1>No data available</h1></center>';
    }
?>



<script>
	window.load = print_d();
	function print_d(){
		window.print();
	}
</script>
    
<!-- end PrintListNew.view -->