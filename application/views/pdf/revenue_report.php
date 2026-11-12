<?php
foreach($lesrevenue as $row){}

	$content = "
	<style>
	table {
		border-collapse: collapse;
		font-size:11px;
		}

	table {
		border-style: solid;
	  border-width: 0px 0px 1px 0px;
		padding:3px;
	}
	th{
		border-style: solid;
	  border-width: 1px 0px 1px 0px;
		padding:10px;
	}
	.td {
		border-style: solid;
		border-width: 0px 0px 1px 0px;
			padding:3px;
		}
		.td1 {
				padding:30px;
			}
			.td2 {
					padding:15px;
				}

	.p1{
		width:220px;
	}
	</style>
	<page backtop=\"5mm\" backbottom=\"5mm\" backleft=\"2mm\" backright=\"2mm\" footer=\"page\">
	<P>Amerijet International -PAP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MESDHASA REVENUE REPORT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:". $this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;At:". $this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8)."</p>
	<P>Report No:".$this->session->numrapport."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PORT-AU-PRINCE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <table>
              <thead>

              <tr>
              <th align='center'>DATE</th>
              <th align='center'>AIRBILL #</th>
              <th align='center'>ROUTING</th>
							<th align='center'>WT&VAL CHGS</th>
              <th align='center'>CHGS DUE AGENT</th>
              <th align='center'>CHGS DUE CARRIER</th>
              <th align='center'>TOTAL DOLLARS</th>
              </tr>
              </thead>
              <tbody>";
							$a=0;
							$b=0;
							foreach($lesrevenue as $row){
								$element='';

				$resdata =	$this->Parser->lescca($row->awbl);
						 if (count($resdata)>0){
							 foreach ($resdata as $row2){
								$element .=$row2->description."<br/>";
							 }
						 }
								$a+=$row->weight_charge;
								$b+=$row->freight;
              $content .= "<tr>
              <td align='center'>".dateVersChainetext($row->Date_of_arrival)."</td>
              <td align='center'>".$row->awbl."<br/>".$element."&nbsp;&nbsp;</td>
              <td align='center'>".$row->Place_of_departure_code."&nbsp;".$row->Place_of_destination_code."</td>
              <td align='center'>".$row->weight_charge."</td>
              <td align='center'>0.00</td>
              <td align='center'>0.00</td>
              <td align='center'>".$row->freight."</td>
              </tr>";
							// $cca=lescca($row->awbl);
          }
              $content .= "<tr>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              </tr>";
              $content .= "<tr>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              </tr>";

              $content .= "<tr>
              <td align='center'>TOTALS===========></td>
              <td align='center'></td>
              <td align='center'></td>
              <td align='center'>".$a."</td>
              <td align='center'>0.00</td>
              <td align='center'>0.00</td>
              <td align='center'>".$b."</td>

              </tr>";


              $content .= "<tr>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              </tr>";
              $content .= "<tr>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>
              <td align='center' class='td' ></td>

              </tr>";
              $content .= "<tr>

              <td colspan='13' align='center' class='td2' >
              <p class='mes_p1'>TOTAL AMOUNT DUE AMERIJET (FOREIGN): $ 0.00</p>
              <p class='mes_p1'>TOTAL NET AMERIJET (DOLLARS): US ".$b."</p>
              </td>
                  </tr>";
                  $content .= "<tr>

                  <td colspan='5' align='right' class='td2' >
                  <p class='mes_p1'>ENTERED BY:________________________</p>
                  <p class='mes_p1'>APROVED BY:_________________________</p>
                  </td>
                  <td colspan='4' align='left' class='td2' >
                  <p class='mes_p1'>DATE:__________________</p>
                  <p class='mes_p1'>DATE:__________________</p>
                  </td>
                      </tr>";
$content .= "</tbody>
</table>
</page>";
$html2pdf = new HTML2PDF('P','Letter','fr', false, 'ISO-8859-15');
$html2pdf->WriteHTML($content);
$html2pdf->Output();
?>
