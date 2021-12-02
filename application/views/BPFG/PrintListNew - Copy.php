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
width:20.99cm ;
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
}

tbody 
{
    font-size: 12px;
    font-weight: bold;
}
span {
    font-size: smaller;
}
</style>
<div style="border-style: double;">
<table width="100%" style="padding:5px 5px 5px 5px;" align="center" cellpadding="0" cellspacing="1">
<thead>
<tr>
    <th colspan="2" rowspan="3"><?php echo "<img src=".base_url()."assets/images/adw.png width='250' height='59'>"; ?></th>
    <th colspan="6" rowspan="2"><h2>BUKTI PENYERAHAN PART</h2></th>
    <th colspan="3" style="background-color: #ccc;">No. Urut Dokumen</th>
</tr>
<tr>
    <th colspan="3"><?php echo $DocNum;?></th>
</tr>
<tr>
    <th colspan="9" align="left"><div style="float: left; width: 45%;">DARI AREA:</div><div style="float: right; width: 45%;">KE AREA:</div></th>
</tr>
<tr>
    <td colspan="5"><strong>Hari & Tanggal:</strong><?php echo $DocDate;?></td>
    <td colspan="6"><strong>Shift:</strong></td>
</tr>
<tr>
    <th>NO</th>
    <th>PART NUMBER</th>
    <th>PART NAME</th>
    <th>CUSTOMER</th>
    <th>QTY<br /><i><span>(Pcs)</span></i></i></th>
    <th colspan="2">DISERAHKAN<br /><i><span>(TTD & Nama Jelas)</span></i></i></th>
    <th colspan="3">DITERIMA<br /><i><span>(TTD & Nama Jelas)</span></i></i></th>
    <th>KETERANGAN<br /><span><i>(Remark)</i></span></th>
</tr>
</thead>
<tbody>
<?php
    $no = 0;
    foreach($data as $row) {
        $no++;
        echo '<tr>
                <td align ="center" width="1%">'.$no.'</td>
                <td width="7%">'.$row->PartNo.'</td>
                <td width="30%">'.$row->PartName.'</td>
                <td align="center" width="9%">'.$row->Code.'</td>
                <td align="center">'.$row->QtyMat.'</td>
                <td>&nbsp;</td>
                <td width="9%">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td width="9%">&nbsp;</td>
                <td>'.$row->Remark.'</td>
              </tr>';
    }
?>
</tbody>
<tfoot>
    <tr>
        <td colspan="11">
            <span>
            <p>Perhatian !</p>
            <p>1. Setiap barang yg keluar dari area / line, wajib mengisi form ini dan kemudian diserahkan ke Administrasi Dept. Masing-masing</p>
            <p>2. Putih yang menyerahkan, merah yang menerima</p>
            <p align="right"><img src="<?php echo site_url();?>/BPFG/bikin_barcode/<?php echo $DocNum ;?>" style="width: 150px;"></p>
            </span>
        </td>
    </tr>
</tfoot>
</table>
</div>

<script>
	window.load = print_d();
	function print_d(){
		window.print();
	}
</script>
    
<!-- end PrintListNew.view -->