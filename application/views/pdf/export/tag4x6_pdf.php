<?php

/*DATA*/
$content="";
if (isset($_SESSION['droit']['a10']) and $_SESSION['droit']['a10'] == "1") {
} else {
  redirect('home/pas_access');
}

foreach ($tag_data as $tag) {
}



$date = date('Y-m-d');
$newdate = date("d-M", strtotime($date));
$date2 = date($tag->date_flight);
$newdate2 = date("d-M", strtotime($date2));




/*---------------------------*/

$style = "<style>
img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 83%;
  height: 14px;
}
.codebar{

  position: absolute;
  padding:0px;
  margin:42px;
  margin-top:21px;
  }
.div1{
position: absolute;
padding:0px;
margin:92px;
font-size:6px;
margin-top:6px;
}
.div2{
position: absolute;
padding:0px;
margin:33px;
font-size:9px;
margin-top:60px;
}

.div3{
position: absolute;
padding:0px;
margin:68px;
font-weight:bold;
font-size:17px;
margin-top:55px;
}
.div4{
position: absolute;
padding:0px;
margin:162px;
font-size:7px;
margin-top:60px;
}
.div5{
position: absolute;
padding:0px;
margin:30px;
font-weight:bold;
font-size:17px;
margin-top:103px;
}
.div6{
position: absolute;
padding:0px;
margin:142px;
font-weight:bold;
font-size:10px;
margin-top:98px;
}
.div7{
position: absolute;
padding:0px;
margin:41px;
font-weight:bold;
font-size:9px;
margin-top:157px;
}

.div8{
position: absolute;
padding:0px;
margin:149px;
min-width: 5px;
font-weight:bold;
font-size:7px;
margin-top:156px;
}
.div9{
position: absolute;
padding:0px;
margin:149px;
font-weight:bold;
font-size:7px;
margin-top:169px;
}
.div10{
position: absolute;
padding:0px;
margin:57px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div11{
position: absolute;
padding:0px;
margin:96px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div12{
position: absolute;
padding:0px;
margin:116px;
font-weight:bold;
font-size:7px;
margin-top:192px;
}
.div13{
position: absolute;
padding:0px;
margin:57px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div14{
position: absolute;
padding:0px;
margin:96px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div15{
position: absolute;
padding:0px;
margin:116px;
font-weight:bold;
font-size:7px;
margin-top:202px;
}
.div16{
  position: absolute;
  padding:0px;
  margin:145px;
  font-weight:bold;
  font-size:7px;
  margin-top:225px;
  }

</style>";
$lb = round($tag->gross_weight * 2.20462);
$awbl1 = $tag->awb_number;
$awbl = explode("-", $awbl1);
$val=000;
for ($x = 1; $x <= $tag->pieces; $x++) {

$content .= "
" . $style . "
<page backimg=\"" . base_url() . "assets/images/LABELFORM.png\" backtop=\"0mm\" backbottom=\"0mm\" backleft=\"0mm\" backright=\"0mm\">
<div class=\"div1\">
$newdate
</div> ";
$content .= "
<div class=\"codebar\">
<img src=\"" . base_url() . "assets/images/cb.php?code=".$tag->awb_number."000".$x."             \" />
</div>";
$content .= "
<div class=\"div2\">
PAP
</div>
<div class=\"div3\">
$awbl[1]
</div>
<div class=\"div4\">
$newdate
</div>
<div class=\"div5\">
$tag->route_to1
</div>
<div class=\"div6\">
$tag->commdity_item_no
</div>

";
$content .= "
<div class=\"div7\">
$x of $tag->pieces
</div>
";
$content .= "
<div class=\"div8\">
$tag->gross_weight K
</div>
<div class=\"div9\">
$lb L
</div>
<div class=\"div10\">
PAP - $tag->route_to1
</div>
<div class=\"div11\">
$tag->route_first_carrier
</div>
<div class=\"div12\">
$tag->flight $newdate2
</div>
<div class=\"div13\">
$tag->route_to1 - $tag->route_to2
</div>
<div class=\"div14\">
$tag->route_by1
</div>
<div class=\"div15\">

</div>
<div class=\"div16\">
$tag->commdity_item_no
</div>
<page_footer class=\"foot\">
</page_footer>
</page>";
}



$html2pdf = new HTML2PDF('P', array(86, 54), 'fr', false, 'ISO-8859-15', array(0, 3, 0, 0));
$html2pdf->pdf->SetTitle('Tag-'.$tag->awb_number);
$html2pdf->WriteHTML($content);
$html2pdf->Output();
