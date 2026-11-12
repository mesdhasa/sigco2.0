<?php require_once('tete.php');
if(isset($_SESSION['droit']['a2']) and $_SESSION['droit']['a2']=="1"){

}else{
	redirect('home/pas_access');
}
libxml_use_internal_errors(true);
@$a = simplexml_load_string($_SESSION['xml']);

if ($a === false) {
    echo '<div class="alert alert-danger">
  <strong>Error!</strong> Failed loading XML.
</div>';
    foreach(libxml_get_errors() as $error) {
        echo "\t", $error->message;
    }
die();
	}
  foreach($lessegments as $row){}
?>

<div class="page-header">
<h1>
<a href="<?php echo $_SERVER['HTTP_REFERER']?>"><i class="fa fa-arrow-circle-left" aria-hidden="true">Back</i></a>
 <small><i class="ace-icon fa fa-angle-double-right"></i>Control XML</small></h1>
</div>
<form method="post" id="form" action="<?php echo base_url('import/save')?>">
					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
                    <?php
                    if($this->session->flashdata('sms2')){
                    	?>
                    <div class="alert alert-danger">
                    <strong>Error!</strong><?php echo $this->session->flashdata('sms2');?>
                    </div>

                    <?php }
                    ?>
										<table id="simple-table" class="table  table-bordered table-hover">
										<p>General segment</p>
											<thead>
												<tr>
													 <th class="center">Date Reg.</th>
													<th class="center">COC</th>
													<th class="center">Flight No.</th>
													<th class="center">Carrier No.</th>
													<th class="center">Carrier</th>
													<th class="center">Departure No.</th>
													<th class="center">Destination No.</th>
													<th class="center">Transport code</th>
												</tr>
											</thead>
											<?php
											$awbl = array();

							foreach($a->General_segment as $Item2){
							foreach($Item2->General_segment_id as $Attribute1){;
                          $awbl['Customs_office_code'] = $Attribute1->Customs_office_code;
							$awbl['Voyage_number'] = $Attribute1->Voyage_number;
                          $awbl['Date_of_departure'] = $Attribute1->Date_of_departure;
                          $awbl['Date_of_arrival'] = $Attribute1->Date_of_arrival;
                          $awbl['Time_of_arrival'] = $Attribute1->Time_of_arrival;

												}


                        foreach($Item2->Transport_information->Carrier as $Attribute3){;
                           $awbl['Carrier_code'] = $Attribute3->Carrier_code;
                           $awbl['Carrier_name'] = $Attribute3->Carrier_name;
                           $awbl['Carrier_address'] = $Attribute3->Carrier_address;
                                }

						foreach($Item2->Transport_information as $Attribute2){;
                          $awbl['Mode_of_transport_code'] = $Attribute2->Mode_of_transport_code;
                          $awbl['Identity_of_transporter'] = $Attribute2->Identity_of_transporter;
                          $awbl['Nationality_of_transporter_code'] = $Attribute2->Nationality_of_transporter_code;
                          $awbl['Place_of_transporter'] = $Attribute2->Place_of_transporter;
						$awbl['Registration_number_of_transport_code'] = $Attribute2->Registration_number_of_transport_code;
                          $awbl['Date_of_registration'] = $Attribute2->Date_of_registration;
                          $awbl['Master_information'] = $Attribute2->Master_information;
												}

						foreach($Item2->Load_unload_place as $Attribute4){;
						$awbl['Place_of_departure_code'] = $Attribute4->Place_of_departure_code;
						$awbl['Place_of_destination_code'] = $Attribute4->Place_of_destination_code;

						}
											?>


											<tbody>
												<tr>
													<td class="center"><?php echo $awbl['Date_of_registration']?></td>
													<td class="center"><?php echo $awbl['Customs_office_code']?></td>
													<td class="center"><?php echo $awbl['Voyage_number']?></td>
													<td class="center"><?php echo $awbl['Carrier_code']?></td>
													<td class="center"><?php echo $awbl['Carrier_name']?></td>
													<td class="center"><?php echo $awbl['Place_of_departure_code'] ?></td>
													<td class="center"><?php echo $awbl['Place_of_destination_code'] ?></td>
													<td class="center"><?php echo $awbl['Registration_number_of_transport_code']?></td>
												</tr>
											</tbody>

  <input type="hidden" name="id" value="<?php echo $idxml;?>">
	<input type="hidden" name="Customs_office_code" value="<?php echo $awbl['Customs_office_code'];?>">
	<input type="hidden" name="Voyage_number" value="<?php echo $awbl['Voyage_number'];?>">
	<input type="hidden" name="Date_of_departure" value="<?php echo $awbl['Date_of_departure'];?>">
	<input type="hidden" name="Date_of_arrival" value="<?php echo $awbl['Date_of_arrival'];?>">
	<input type="hidden" name="Time_of_arrival" value="<?php echo $awbl['Time_of_arrival'];?>">
	<input type="hidden" name="Carrier_code" value="<?php echo $awbl['Carrier_code'];?>">
	<input type="hidden" name="Carrier_name" value="<?php echo $awbl['Carrier_name'];?>">
	<input type="hidden" name="Carrier_address" value="<?php echo $awbl['Carrier_address'];?>">
	<input type="hidden" name="Mode_of_transport_code" value="<?php echo $awbl['Mode_of_transport_code'];?>">
	<input type="hidden" name="Identity_of_transporter" value="<?php echo $awbl['Identity_of_transporter'];?>">
	<input type="hidden" name="Nationality_of_transporter_code" value="<?php echo $awbl['Nationality_of_transporter_code'];?>">
	<input type="hidden" name="Place_of_transporter" value="<?php echo $awbl['Place_of_transporter'];?>">
	<input type="hidden" name="Registration_number_of_transport_code" value="<?php echo $awbl['Registration_number_of_transport_code'];?>">
	<input type="hidden" name="Date_of_registration" value="<?php echo $awbl['Date_of_registration'];?>">
	<input type="hidden" name="Master_information" value="<?php echo $awbl['Master_information'];?>">
	<input type="hidden" name="Place_of_departure_code" value="<?php echo $awbl['Place_of_departure_code'];?>">
	<input type="hidden" name="Place_of_destination_code" value="<?php echo $awbl['Place_of_destination_code'];?>">
	<input type="hidden" name="status" value="<?php $status=array("status"=>"0"); echo $status['status'];?>">

											<?php
											}
											?>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
										<p>AWB</p>
											<thead>
												<tr>
                          <th class="center">Line number</th>
													<th class="center">AWB No.</th>
													<th class="center">Qty</th>
													<th class="center">Nature of goods</th>
													<th class="center">Weight (KGS)</th>
													<th class="center">Consignee</th>
													<th class="center">Freight</th>
													<th class="center">Currency</th>
												</tr>
											</thead>
											<?php
											$i=0;
                       $awbl = array();
											foreach($a->Bol_segment as $Item3){
												//Now you can access the 'row' data using $Item in this case
												// two elements, a name and an array of key/value pairs

												foreach($Item3->Bol_id as $Attribute){$i++;
													$awbl['Bol_reference'][] 			= $Attribute->Bol_reference;
													$awbl['Line_number'][] 				= $Attribute->Line_number;
													$awbl['Bol_nature'][] 				= $Attribute->Bol_nature;
													$awbl['Bol_type_code'][] 			= $Attribute->Bol_type_code;
													$awbl['Unique_carrier_reference'][] = $Attribute->Unique_carrier_reference;
												}
												foreach($Item3->Load_unload_place as $Attribute2){$i++;
													$awbl['Place_of_loading_code'][] = $Attribute2->Place_of_loading_code;
                          $awbl['Place_of_unloading_code'][] = $Attribute2->Place_of_unloading_code;
                          $awbl['Place_of_boarding_code'][] = $Attribute2->Place_of_boarding_code;
												}
												foreach($Item3->Traders_segment->Exporter as $Attribute6){$i++;
													$awbl['Exporter_name'][] = $Attribute6->Exporter_name;
                          $awbl['Exporter_address'][] = $Attribute6->Exporter_address;
												}
                        foreach($Item3->Traders_segment->Notify as $Attribute7){$i++;
                          $awbl['Notify_code'][] = $Attribute7->Notify_code;
							$awbl['Notify_name'][] = $Attribute7->Notify_name;
                          $awbl['Notify_address'][] = $Attribute7->Notify_address;
												}
                        foreach($Item3->Traders_segment->Consignee as $Attribute3){$i++;
													$awbl['Consignee_name'][] = $Attribute3->Consignee_name;
                          $awbl['Consignee_address'][] = $Attribute3->Consignee_address;
												}
												foreach($Item3->Goods_segment as $Attribute4){$i++;
													$awbl['Number_of_packages'][] = $Attribute4->Number_of_packages;
													$awbl['Package_type_code'][] = $Attribute4->Package_type_code;
                          $awbl['Gross_mass'][] = $Attribute4->Gross_mass;
                          $awbl['Shipping_marks'][] = $Attribute4->Shipping_marks;
													$awbl['Goods_description'][] = $Attribute4->Goods_description;
                          $awbl['Volume_in_cubic_meters'][] = $Attribute4->Volume_in_cubic_meters;
                          $awbl['Num_of_ctn_for_this_bol'][] = $Attribute4->Num_of_ctn_for_this_bol;
												}
                        foreach($Item3->Goods_segment->Seals_segment as $Attribute8){$i++;
                          $awbl['Number_of_seals'][] = $Attribute8->Number_of_seals;

                        }
												foreach($Item3->Value_segment->Freight_segment as $Attribute5){$i++;
                          $awbl['PC_indicator'][] = $Attribute5->PC_indicator;
													$awbl['Freight_value'][] = $Attribute5->Freight_value;
													$awbl['Freight_currency'][] = $Attribute5->Freight_currency;
												}
                        foreach($Item3->Value_segment->Customs_segment as $Attribute9){$i++;
                          $awbl['Customs_value'][] = $Attribute9->Customs_value;
                          $awbl['Customs_currency'][] = $Attribute9->Customs_currency;
                        }
                        foreach($Item3->Value_segment->Insurance_segment as $Attribute10){$i++;
                          $awbl['Insurance_value'][] = $Attribute10->Insurance_value;
                          $awbl['Insurance_currency'][] = $Attribute10->Insurance_currency;
                        }
                        foreach($Item3->Value_segment->Transport_segment as $Attribute11){$i++;
                          $awbl['Transport_value'][] = $Attribute11->Transport_value;
                          $awbl['Transport_currency'][] = $Attribute11->Transport_currency;
                        }
                        foreach($Item3->Location as $Attribute12){$i++;
                          $awbl['Location_code'][] = $Attribute12->Location_code;
                          $awbl['Location_info'][] = $Attribute12->Location_info;
                        }

											}

											?>

											<?php
											for($r=0;$r<count($awbl['Bol_reference']);$r++){



											?>
											<tbody>
												<tr>
                          <td class="center"><?php echo $awbl['Line_number'][$r]?></td>
													<td class="center"><?php echo $awbl['Bol_reference'][$r]?></td>
													<td class="center"><?php echo $awbl['Number_of_packages'][$r]?></td>
													<td class="center"><?php echo $awbl['Goods_description'][$r]?></td>
													<td class="center"><?php echo $awbl['Gross_mass'][$r]?></td>
													<td class="center"><?php echo $awbl['Consignee_name'][$r]?></td>
													<td class="center"><?php echo $awbl['Freight_value'][$r]?></td>
													<td class="center"><?php echo $awbl['Freight_currency'][$r]?></td>
												</tr>
											</tbody>
				<input type="hidden" name="notify_code[]" value="<?php echo $awbl['Notify_code'][$r]?>">
				<input type="hidden" name="notify_name[]" value="<?php echo $awbl['Notify_name'][$r]?>">
				<input type="hidden" name="notify_address[]" value="<?php echo $awbl['Notify_address'][$r]?>">
				<input type="hidden" name="ref[]" value="<?php echo $awbl['Bol_reference'][$r]?>">
				<input type="hidden" name="packages[]" value="<?php echo $awbl['Number_of_packages'][$r]?>">
				<input type="hidden" name="description[]" value="<?php echo $awbl['Goods_description'][$r]?>">
				<input type="hidden" name="mass[]" value="<?php echo $awbl['Gross_mass'][$r]?>">
			  <input type="hidden" name="name[]" value="<?php echo $awbl['Consignee_name'][$r]?>">
				<input type="hidden" name="value[]" value="<?php echo $awbl['Freight_value'][$r]?>">
				<input type="hidden" name="currency[]" value="<?php echo $awbl['Freight_currency'][$r]?>">
													<?php


											}
		
											?>


										</table>


									</div><!-- /.span -->
								</div><!-- /.row -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
										<p>Totals XML</p>
											<thead>
												<tr>
													<th class="center"></th>
													<th class="center">Total AWB.</th>
													<th class="center">Total PCS.</th>
													<th class="center">Total Weight (KGS).</th>
												</tr>
											</thead>

											<?php
											$b=0;
											$c=0;
											$d=0;
										for($r=0;$r<count($awbl['Bol_reference']);$r++){
										$b+=$awbl['Gross_mass'][$r];
										$c+=$awbl['Number_of_packages'][$r];
										}
											?>

											<tbody>
												<tr>
												<td class="center">Totals Segment ID</td>

													<td class="center"><?php echo count($awbl['Bol_reference']);?></td>
													<td class="center"><?php echo $c?></td>
													<td class="center"><?php echo $b?></td>
												</tr>
											</tbody>
                      <?php $is_true=false; foreach($a->General_segment->Totals_segment as $Item){
if((count($awbl['Bol_reference'])==$Item->Total_number_of_bols) && ($c==$Item->Total_number_of_packages) &&($b==$Item->Total_gross_mass)){
                      				$is_true=true;
                      		}
                       ?>
                      <tbody>
                        <tr>
                          <td class="center">Segment</td>
                          <td class="center"><?php echo $Item->Total_number_of_bols ?></td>
                          <td class="center"><?php echo $Item->Total_number_of_packages?></td>
                          <td class="center"><?php echo $Item->Total_gross_mass ?></td>
                         <!-- <td class="center"><?php echo $Item->Total_number_of_containers ?></td> -->
                        </tr>
                      </tbody>
                      <?php
                      }
                      ?>
										</table>
									</div><!-- /.span -->
									<?php if($is_true){?>
									<button class="btn btn-sm btn-primary" type="submit">
													   <i class="ace-icon fa fa-save"></i>
													Sauvegarder
													</button>
									<?php }?>
									<a class="btn btn-sm btn-primary" href="<?php echo base_url()?>import/creer/i/ajouter/">
									<i class="ace-icon fa fa-close"></i>
									Fermer
									</a>
								</div><!-- /.row -->
				               <!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div></form>

					<!-- /.page-content -->

<?php require_once('pied.php');?>
