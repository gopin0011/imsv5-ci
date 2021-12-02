<!-- start PrintListNew.view -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
<style>
page[size="letter"] {  
  width: 24.1cm;
  height: 28.5cm; 
}
page[size="letter"][layout="portrait"] {
  width: 24.1cm;
  height: 28.5cm;  
}
@media screen {
  div.divFooter {
    
  }
}
@media print {
  div.divFooter {
    position: fixed;
    bottom: 0;
    width:99%;
  }
}

@page {
  size: A4;
  margin: 0;
}

@media print {
  html, body {
    width: 214mm;
    height: 276mm;
  }
}

@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block; page-break-before: always; 
    }
}
.pagebreak {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}


span {
    font-size: small;
}


table tr, table td, table th
{
    padding: 5;
}

table th {
    text-align: center;
}

thead {
    font-size: 15px;
}

tbody, tfoot 
{
    font-size: 12px;
    font-weight: bold;
}

table tfoot tr td {
    border-top:1pt solid black;    
}

tr.tr_head th {
  border-bottom:1pt solid black;
  border-top:1pt solid black;
}

.images {
  position: relative;
  display: inline-block;
  float: right;
}

.images p {
  position: absolute;
  width: 100%;
  text-align: right;
  bottom: 0;
  left: 0;
  font-size: small;
}

h2 {
    display: inline-block;
}

.line {
    border: solid 1px black;
    padding-left: 20;
    padding-right: 20;
    padding-top: 5;
}

span.label {
    font-style: italic;
    color: black;
    font-size: 12;
}

body {
    margin: 5;
    margin-top: 20;
}

table.header,table.footer {
    border-collapse: collapse;  
}

table.header tr, table.header td,table.footer tr, table.footer td {
    border: 1px solid black;  
    padding: 5;
}


h4, h5 {
    text-align: center;
}

h5 {
    font-weight: bold;
}

h4.partner {
    text-align: left;
}

.ttd {
    border: 1px solid black;
    text-align: center;
    width: auto;
    float:left;
}

tr.footqty, tr.footqty td {
    border-top:solid 1px black;
}

#footer-2 {
    clear: both;
    position: relative;
    z-index: 10;
    height: 3em;
    margin-top: -3em;
}

</style>
<page size="letter" layout="portrait">
<?php
    $g_total=0;
    $no=1;
    $page =1;
    
    //echo"<pre>";
    //print_r($head);
    //echo"</pre>";
    
    function myheader($kanan,$DocNum,$DocDate,$PONum,$DNRef,$PartnerName,$DlvAddress,$username,$CarNum,$ShipTime,$ShipCycle,$shipper,$Remark,$page,$ofPage)
    {
        echo "<br>";
        echo '<table width="100%"><tr><td width="50%">';
        echo '<span>PT. Summit Adyawinsa Indonesia<br>';
        echo 'Jl. Pangkal Perjuangan (By Pass) No. 98 Tanjung Mekar<br>';
        echo 'Karawang, Jawa Barat 41316<br>';
        echo 'Indonesia<br>';
        echo 'Ph: +62 267 415815 Fax: +62 267 415814</span></td>';
        echo '<td width="50%"><div class="images"><img src="'.base_url().'assets/images/adw.png" width="250" height="59"><br><br><br><p>page: '.$page.' of '.$ofPage.'</p></div></td></tr></table>';
        echo '<br><br><table width="100%" class="header">';
        echo '<tr><td width="50%"><h2>Surat Jalan General</h2><span style="margin-left:200;">User: '.$username.'</span></td>';
        echo '<td width="25%"><span class="label1">Reg No</span><p align="center"><h5>'.$DocNum.'</h5></p></td>';
        echo '<td width="25%"><span class="label1">Date</span><p align="center"><h5>'.$DocDate.'</h5></p></td><tr>';
        echo '<tr><td rowspan="3"><span class="label1">Ship to:</span><h4 class="partner">'.$PartnerName.'</h4><br>'.$DlvAddress.'<br><br></td>';
        echo '<td colspan="2">Remark: '.$Remark.'</td></tr>';
        echo '<tr><td colspan="2" align="center">Transportation Data Filled by Security</td></tr>';
        echo '<tr><td>Car Num: '.$CarNum.'<br><br><br>Time Out: '.$ShipTime.'</td><td><p align="center">Checked By<br><br><br></p>Name: </td></tr>';
        echo '</table>';
        echo '<div class="row"><div class="col-md-12">&nbsp;</div></div>';
        echo '<table width="100%" align="center" cellpadding="7" cellspacing="0">';
        echo $kanan;
        echo '<tbody>';
    }
    
    function myfooter($username,$dept,$SectionHead,$DriverName,$ShipTime)
    {	
        echo "</tbody>";
    	echo "</table>";
        echo '<div class="divFooter">';
        echo '<table width="100%" class="footer" align="center"><tr><td align="center" colspan="3">Transfered Legalization</td>';
        echo '<td align="center" colspan="2">Transfered Legalization</td></tr>';
        echo '<tr><td width="16%" align="center" rowspan="2">Transfered By<hr style="height:11pt; visibility:hidden;" /><u>'.$username.'</u><br>'.$dept.'</td><td width="18%" align="center" rowspan="2">Approve By<hr style="height:11pt; visibility:hidden;" /><u>'.$SectionHead.'</u>&nbsp;<br>Sec/Div. Head</td><td width="16%" align="center" rowspan="2">Delivered By<hr style="height:11pt; visibility:hidden;" /><u>'.$DriverName.'</u>&nbsp;<br>Driver</td>';
        echo '<td colspan="2" style="border-right:none;">Time Out: '.$ShipTime.'</td></tr>';
        echo '<tr><td style="border-right:none; line-height:13px">Received By<hr style="height:11pt; visibility:hidden;" />Name Occupation:</td><td style="border-left:none; vertical-align:top;">Signature & Comp. Stamp</td></tr>';
        echo '</table>';
        echo "<div class='row'><div class='col-md-4 col-md-offset-8'><span class='pull-right'>Print Date: <b>".date('d-m-Y')."</b></span></div></div>";
        echo '</div>';
    }
    
    function myfooter_last($qty,$username,$dept,$SectionHead,$DriverName,$ShipTime)
    {	
        echo "</tbody>";
        echo "<tr class='footqty'>";
        echo "<td colspan='4' align='right'>Total Qty:</td>";
        echo "<td align='right'>".$qty."</td><td>&nbsp;</td>";
        echo "</tr>";
        echo "</table>";
        echo '<div class="divFooter">';
        echo '<table width="100%" class="footer" align="center"><tr><td align="center" colspan="3">Transfered Legalization</td>';
        echo '<td align="center" colspan="2">Transfered Legalization</td></tr>';
        echo '<tr><td width="16%" align="center" rowspan="2">Transfered By<hr style="height:11pt; visibility:hidden;" /><u>'.$username.'</u><br>'.$dept.'</td><td width="18%" align="center" rowspan="2">Approve By<hr style="height:11pt; visibility:hidden;" /><u>'.$SectionHead.'</u>&nbsp;<br>Sec/Div. Head</td><td width="16%" align="center" rowspan="2">Delivered By<hr style="height:11pt; visibility:hidden;" /><u>'.$DriverName.'</u>&nbsp;<br>Driver</td>';
        echo '<td colspan="2" style="border-right:none;">Time Out: '.$ShipTime.'</td></tr>';
        echo '<tr><td style="border-right:none">Received By<hr style="height:11pt; visibility:hidden;" />Name Occupation:</td><td style="border-left:none; vertical-align:top;">Signature & Comp. Stamp</td></tr>';
        echo '</table>';  
        echo "<div class='row'><div class='col-md-4 col-md-offset-8'><span class='pull-right'>Print Date: <b>".date('d-m-Y')."</b></span></div></div>";
        echo '</div>';
    }
    
    $kanan = '<thead>
                <tr class="tr_head">
                    <th width="35">NO</th>
                    <th width="350">Product Name</th>
                    <th>Specs</th>
                    <th>Remark</th>
                    <th>Quantity</th>
                    <th>UoM</th>
                </tr>
            </thead>';
    
    foreach($data as $row)
    {
        if(($no%15) == 1){
            $ofPage = ceil(($num) / 15);
            if($no > 1){
                myfooter($head->username,$head->Dept_Name,$head->SectionHead,$head->DriverName,$head->ShipTime);
                echo '<div class="page-break"></div>';
                $page++;
            } 
            myheader($kanan,$head->DocNum,$head->DocDate,$head->PONum,$head->DNRef,$head->PartnerName,$head->DlvAddress,$head->username,$head->CarNum,$head->ShipTime,$head->ShipCycle,$head->Shipper,$head->Remark,$page,$ofPage);
        }
        
        echo '<tr>
                <td align ="center">'.$no.'</td>
                <td>'.$row->PartName.'</td>
                <td>'.$row->JobNumber.'</td>
                <td align="center">'.$row->OrderReference.'</td>
                <td align="right">'.$row->Quantity.'</td>
                <td>'.$row->unit.'</td>
              </tr>';
        $no++;
        $ofPage = ceil(($num) / 15);
    }
    
    myfooter_last($TotalQty,$head->username,$head->Dept_Name,$head->SectionHead,$head->DriverName,$head->ShipTime);
    
?>
</page>
<script>
    window.print();
</script>

<!-- end PrintListNew.view -->