				<?php
				require_once APPPATH."/third_party/ctools.php";

				class Parser_export extends CI_Model
				{
				public function __construct(){

				}
				public function get_manifeste()
				{
				$this->db->select('*');
				$this->db->join('compaganie', 'compaganie.idcompagnie = manifeste.idcompagnie','inner');
				$this->db->where('status', '0');
				$this->db->order_by("id_manifeste", "DESC");
				$query = $this->db->get('manifeste');
				return $query->result();
				}
				public function get_all_awb()
				{

				$sql="SELECT awbl.awb_number,awbl.void, awbl.id_awbl, awbl.total_freight, awbl.qty, warehouse.gross_weight, warehouse.id_warehouse, awbl.id_manifeste FROM awbl
				INNER JOIN warehouse ON (warehouse.no_awbl = awbl.awb_number) where id_manifeste='0'  or id_manifeste  IS NULL
				ORDER BY awbl.awb_number ASC";
				$query = $this->db->query($sql);
				return $query->result();
				}
				public function get_all_awb_vol($id)
				{
					$sql="SELECT awbl.awb_number, ANY_VALUE(awbl.id_manifeste) AS `id_manifeste`, ANY_VALUE(awbl.id_awbl) AS `id_awbl`, ANY_VALUE(awbl.void) AS `void`, ANY_VALUE(awbl.qty) AS `qty`, ANY_VALUE(warehouse.nature_and_quantity) AS `nature_and_quantity`, ANY_VALUE(warehouse.gross_weight) AS `gross_weight`, ANY_VALUE(awbl.name_shipper) AS `name_shipper`, ANY_VALUE(awbl.name_agent) AS `name_agent`, ANY_VALUE(awbl.name_consignee) AS `name_consignee`, ANY_VALUE(awbl.total_freight) AS `total_freight`, ANY_VALUE(awbl.rate_Charge) AS `rate_Charge`, ANY_VALUE(awbl.wt_val) AS `wt_val`, ANY_VALUE(awbl.commdity_item_no) AS `commdity_item_no`, SUM((warehouse_colis.no_pieces*warehouse_colis.dim1*warehouse_colis.dim2*warehouse_colis.dim3)/366) as totalvolum, ANY_VALUE(awbl.currency) AS `currency`
					 FROM awbl
				
				INNER JOIN warehouse ON (warehouse.no_awbl = awbl.awb_number) 
				INNER JOIN warehouse_colis ON (warehouse.no_warehouse = warehouse_colis.id_warehouse) 
				where id_manifeste=?  
				GROUP BY awbl.awb_number
				ORDER BY awbl.awb_number ASC";
				
				$query = $this->db->query($sql, array($id));
				return $query->result();


				// $this->db->order_by("datecreated", "ASC");
				// $this->db->where('id_manifeste ',$id);
				// $this->db->join('warehouse', 'warehouse.no_awbl = awbl.awb_number','inner');
				// $this->db->join('buil', 'buil.no_awbl = awbl.awb_number','inner');
				// $this->db->group_by("awbl.awb_number");
				// $query = $this->db->get('awbl' );
				// return $query->result();
				}
				public function get_all_awb_vol2($id)
				{
					
				// 	$sql="SELECT awbl.awb_number,awbl.id_manifeste,awbl.id_awbl,awbl.void,awbl.qty,warehouse.nature_and_quantity,
				// 	warehouse.gross_weight,awbl.name_shipper,awbl.name_agent,awbl.name_consignee,awbl.total_freight,awbl.rate_Charge,awbl.wt_val,awbl.commdity_item_no,SUM((warehouse_colis.no_pieces*warehouse_colis.dim1*warehouse_colis.dim2*warehouse_colis.dim3)/366) as totalvolum,awbl.currency
				// FROM awbl
				
				// INNER JOIN warehouse ON (warehouse.no_awbl = awbl.awb_number) 
				// INNER JOIN warehouse_colis ON (warehouse.no_warehouse = warehouse_colis.id_warehouse) 
				// where id_manifeste='$id'  
				// GROUP BY awbl.awb_number
				// ORDER BY awbl.awb_number ASC";
				
				// $query = $this->db->query($sql);
				// return $query->result();

				
				// ONLY_FULL_GROUP_BY (MySQL 8/9) : "*" remplace par les colonnes explicites en ANY_VALUE(), resultat identique
				$this->db->select(sigco_colonnes_any_value(array('awbl', 'warehouse', 'warehouse_colis')), FALSE);
				$this->db->order_by('awbl.awb_number', 'ASC');
				$this->db->where('id_manifeste ',$id);
				$this->db->join('warehouse', 'warehouse.no_awbl = awbl.awb_number','inner');
				$this->db->join('warehouse_colis', 'warehouse.no_warehouse  = warehouse_colis.id_warehouse','inner');
				$this->db->group_by("awbl.awb_number");
				$query = $this->db->get('awbl');
				return $query->result();


				}

				public function entitlement_agent2($id)
				{
				$this->db->where('entitlement', 'Due Agent');
				$this->db->where('id_other', $id);
				$this->db->select('SUM(tbl_other_charges.amount) as TotalDueAgent');
				$query = $this->db->get('tbl_other_charges');
				return $query->result();
				}
				public function entitlement_carrier2($id)
				{
				$this->db->where('entitlement', 'Due Carrier');
				$this->db->where('id_other', $id);
				$this->db->select('SUM(tbl_other_charges.amount) as TotalDueCarrier');
				$query = $this->db->get('tbl_other_charges');
				return $query->result();
				}

				public function update_manifest_awbl ($id,$data)
				{
				$this->db->where('id_manifeste', $id);
				$this->db->update('manifeste', $data);
				return $query;
				}
				public function set_les_awbl($data)
				{
				$query = $this->db->update_batch('awbl', $data, 'id_awbl');
				return $query;
				}
				public function get_reservation()
				{
				$this->db->select('*');
				$this->db->join('compaganie', 'compaganie.idcompagnie = reservation.idcompagnie','inner');
				$this->db->where('status', '0');
				$this->db->order_by("id_reservation", "DESC");
				$query = $this->db->get('reservation');
				return $query->result();
				}
				public function set_prepaidcollect($id,$pp,$cl,$nc)
				{
				$data = array(
				'prepaid' 	=> $pp,
				'collect' 	=> $cl,
				'nocharge'	=> $nc
				);

				$this->db->where('no_awbl', $id);
				$this->db->update('reservation', $data);
				return $query;
				}
				public function get_compagnie()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('compaganie');
				return $query->result();
				}
				public function get_rate_class()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('tbl_rate_class');
				return $query->result();
				}
				public function get_commodity()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('tbl_commodity');
				return $query->result();
				}
				public function get_charges_codes()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('tbl_charges_codes');
				return $query->result();
				}
				public function get_entitlement()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('tbl_entitlement');
				return $query->result();
				}
				public function entitlement_agent($id)
				{
				$this->db->where('entitlement', 'Due Agent');
				$this->db->where('id_other', $id);
				$query = $this->db->get('tbl_other_charges');
				return $query->result();
				}
				public function entitlement_carrier($id)
				{
				$this->db->where('entitlement', 'Due Carrier');
				$this->db->where('id_other', $id);
				$query = $this->db->get('tbl_other_charges');
				return $query->result();
				}
				public function get_entitlement2($id)
				{
				$this->db->where('id_other', $id);
				$query = $this->db->get('tbl_other_charges');
				return $query->result();
				}
				public function get_description_awb()
				{
				$this->db->where('statut', '1');
				$query = $this->db->get('description_awb');
				return $query->result();
				}
				public function add_manifeste($data)
				{
				$query = $this->db->insert('manifeste', $data);
				return $query;
				}
				public function add_reservation($data)
				{

				$query = $this->db->insert('reservation', $data);
				return $query;
				}
				public function add_warehouse($data)
				{
				$query = $this->db->insert('warehouse', $data);
				return $query;
				}
				public function add_awbl($data_awb)
				{
				$query = $this->db->insert('awbl', $data_awb);
				return $query;
				}
				public function add_warehouse_colis($data)
				{
				$query = $this->db->insert('warehouse_colis', $data);
				return $query;
				}
				public function add_other_charges($data)
				{
				$query = $this->db->insert('tbl_other_charges', $data);
				return $query;
				}
				public function set_warehouse_colis($data2)
				{
				$query = $this->db->insert_batch('warehouse_colis', $data2);
				return $query;
				}
				public function update_warehouse($id,$data)
				{
				$this->db->where('no_warehouse', $id);
				$this->db->update('warehouse', $data);
				return $query;
				}
				public function update_awbl($id,$data)
				{
				$this->db->where('id_awbl', $id);
				$this->db->update('awbl', $data);
				return $query;
				}
				public function update_awbl2($id,$data)
				{
				$this->db->where('awbl', $id);
				$this->db->update('buil', $data);
				return $query;
				}
				// public function update_warehouse_colis($data2)
				// {
				// // $this->db->where('id_warehouse', $id2);
				// // $query = $this->db->update_batch('warehouse_colis', $data2);
				// // return $query;
				// $query = $this->db->update_batch('warehouse_colis', $data2, 'id_wc');
				// return $query;
				// }
				public function update_reserv_warehouse($data3,$id)
				{
				$this->db->where('no_reservation', $id);
				$this->db->update('reservation', $data3);
				return $query;
				}

				public function set_a_manifeste($id,$data)
				{
				$this->db->where('id_manifeste', $id);
				$this->db->update('manifeste', $data);
				return $query;
				}
				public function set_a_reservation($id,$data)
				{
				$this->db->where('id_reservation', $id);
				$this->db->update('reservation', $data);
				return $query;
				}
				public function set_warehouse($id,$data)
				{
				$this->db->where('id_warehouse', $id);
				$this->db->update('warehouse', $data);
				return $query;
				}
				public function get_lemanifeste($id)
				{
				$this->db->where('id_manifeste', $id);
				$query = $this->db->get('manifeste');
				return $query->result();
				}
				public function get_lemanifeste2($id)
				{
				$this->db->where('id_manifeste', $id);
				$this->db->join('compaganie', 'compaganie.idcompagnie= manifeste.idcompagnie','inner');
				$query = $this->db->get('manifeste');
				return $query->result();
				}

				public function get_lareservation($id)
				{
				$this->db->where('id_reservation', $id);
				$query = $this->db->get('reservation');
				return $query->result();
				}
				public function init_antrepot($id)
				{
				$this->db->where('no_awbl', $id);
				$query = $this->db->get('warehouse');
				return $query->result();
				}
				public function get_antrepot($id)
				{
				$this->db->where('no_warehouse', $id);
				$query = $this->db->get('warehouse');
				return $query->result();
				}
				public function get_antrepot_pdf($id)
				{
				$this->db->where('no_warehouse', $id);
				$this->db->join('compaganie', 'compaganie.idcompagnie = warehouse.idcompagnie','inner');
				$query = $this->db->get('warehouse');
				return $query->result();
				}
				public function get_allclient2()
				{
				$this->db->order_by("reference", "ASC");
				$this->db->where('codeclient !=','cash');
				$query = $this->db->get('tbl_client');
				return $query->result();
				}
				public function get_antrepot_pcs($id)
				{
				$this->db->where('id_warehouse', $id);
				$query = $this->db->get('warehouse_colis');
				return $query->result();
				}
				public function get_awb_data($id)
				{
				$this->db->where('awb_number', $id);
				$query = $this->db->get('awbl');
				return $query->result();
				}
				public function delete_manifeste($id)
				{
				$this->db->where('id_manifeste', $id);
				$query = $this->db->delete('manifeste');

				return $query;
				}
				public function delete_reservation($id)
				{
				$this->db->where('id_reservation', $id);
				$query = $this->db->delete('reservation');

				return $query;
				}
				public function delete_warehouse_colis($id)
				{
				$this->db->where('id_wc', $id);
				$query = $this->db->delete('warehouse_colis');

				return $query;
				}
				public function delete_other_charges($id)
				{
				$this->db->where('id', $id);
				$query = $this->db->delete('tbl_other_charges');

				return $query;
				}
				public function delete_warehouse_colis2($id)
				{
				$this->db->where('id_warehouse', $id);
				$query = $this->db->delete('warehouse_colis');

				return $query;
				}
				public function delete_awbl($id)
				{
				$this->db->where('awb_number', $id);
				$query = $this->db->delete('awbl');

				return $query;
				}
				public function delete_warehouse($id)
				{
				$this->db->where('id_warehouse', $id);
				$query = $this->db->delete('warehouse');

				return $query;
				}

				public function verify_awbl($id)
				{
				$this->db->where('awbl', $id);
				$query = $this->db->get('tbl_facture');

				if($query->num_rows()>0){
				return true;
				}else{
				return false;
				}
				}
				public function verify_awbl2($id)
				{
				$this->db->where('awb', $id);
				$query = $this->db->get('awb_by_compagnie');

				if($query->num_rows()>0){
				return true;
				}else{
				return false;
				}
				}
				public function verify_noreserv($id)
				{
				$this->db->where('no_reservation', $id);
				$query = $this->db->get('reservation');

				if($query->num_rows()>0){
				return true;
				}else{
				return false;
				}
				}
				public function verify_awbl_table($id)
				{
				$this->db->where('awb_number', $id);
				$query = $this->db->get('awbl');

				if($query->num_rows()>0){
				return true;
				}else{
				return false;
				}
				}
				public function get_noawbl($id)
				{
				$this->db->where('no_awbl', $id);
				$query = $this->db->get('reservation');
				return $query->result();
				}
				public function recherche_vol($flight)
				{
				$this->db->select('');
				$this->db->join('compaganie', 'compaganie.idcompagnie = manifeste.idcompagnie','inner');
				$this->db->like('flight', $flight);
				$this->db->order_by("date", "DESC");
				$query = $this->db->get('manifeste');
				return $query->result();
				}
				public function recherche_noreservpdf($id)
				{
				$this->db->where('no_reservation', $id);
				$query = $this->db->get('reservation');
				return $query->result();
				}
				public function lareserv($id)
				{
				$this->db->join('compaganie', 'compaganie.idcompagnie = reservation.idcompagnie','inner');
				$this->db->where('no_awbl', $id);
				$query = $this->db->get('reservation');
				return $query->result();
				}
				public function recherche_reserv($custum)
				{
				$this->db->select('');
				$this->db->join('compaganie', 'compaganie.idcompagnie = reservation.idcompagnie','inner');
				$this->db->like('no_reservation', $custum);
				$this->db->or_like('no_awbl', $custum);
				$this->db->or_like('shipper', $custum);
				$this->db->or_like('consignee', $custum);

				$this->db->order_by("date", "DESC");
				$query = $this->db->get('reservation');
				return $query->result();
				}
				// Pagination serveur : $limit/$offset optionnels (NULL = toutes les lignes, comme avant)
				private function _filtre_recherche_warehouse($custum)
				{
				$this->db->like('no_warehouse', $custum);
				$this->db->or_like('nom_ch', $custum);
				// $this->db->join('awbl', 'awbl.awb_number = warehouse.no_awbl','inner');
				$this->db->or_like('prenom_ch', $custum);
				$this->db->or_like('nom_p', $custum);
				}
				public function compter_recherche_warehouse($custum)
				{
				$this->_filtre_recherche_warehouse($custum);
				return $this->db->count_all_results('warehouse');
				}
				public function recherche_warehouse($custum, $limit = NULL, $offset = 0)
				{
				$this->db->select('');
				$this->_filtre_recherche_warehouse($custum);
				$this->db->order_by("ladate", "DESC");
				$this->db->order_by("id_warehouse", "DESC");
				if ($limit !== NULL) { $this->db->limit((int) $limit, (int) $offset); }
				$query = $this->db->get('warehouse');
				return $query->result();
				}
				private function _filtre_recherche_awbl_export($custum)
				{
				$this->db->like('awb_number', $custum);
				$this->db->or_like('account_number_shipper', $custum);
				$this->db->or_like('name_shipper', $custum);
				$this->db->or_like('account_number_consignee', $custum);
				$this->db->or_like('name_consignee', $custum);
				$this->db->join('warehouse', 'warehouse.no_awbl= awbl.awb_number','inner');
				}
				public function compter_recherche_awbl_export($custum)
				{
				$this->_filtre_recherche_awbl_export($custum);
				return $this->db->count_all_results('awbl');
				}
				public function recherche_awbl_export($custum, $limit = NULL, $offset = 0)
				{
				$this->db->select('');
				$this->_filtre_recherche_awbl_export($custum);
				if ($limit !== NULL) { $this->db->order_by('awbl.id_awbl', 'ASC'); $this->db->limit((int) $limit, (int) $offset); }

				$query = $this->db->get('awbl');
				return $query->result();
				}

				public function recherche_vol_date($date1,$date2)
				{
				// Parametres valides (AUDIT-001)
				$date1 = sigco_date($date1); $date2 = sigco_date($date2);
				$this->db->select('');
				$this->db->join('compaganie', 'compaganie.idcompagnie = manifeste.idcompagnie','inner');
				$where = "DATE(date) BETWEEN " . $this->db->escape($date1) . " AND " . $this->db->escape($date2);
				$query = $this->db->where($where)->get('manifeste');
				return $query->result();
				}

				public function verify_warehouse($no_warehouse){

				$this->db->where('no_warehouse', $no_warehouse);
				$this->db->where('no_awbl IS  NULL');
				$query = $this->db->get('warehouse');

				if($query->num_rows()>0){
				return true;
				}else{
				return false;
				}

				}
				public function verify_warehouse2($no_warehouse){

				$this->db->where('no_warehouse', $no_warehouse);
				$this->db->where('no_awbl IS NULL');
				$query = $this->db->get('warehouse');
				return $query->result();

				}
				public function get_awb_bycom($id)
				{
				$this->db->where('id_compagnie', $id);
				$this->db->where('statut', '0');
				$this->db->order_by('awb',"ASC");
				$this->db->limit(1);
				$query = $this->db->get('awb_by_compagnie');
				return $query->result();
				}

				public function creation_bill_export($addawbl,$no_warehouse,$compagnie){

				// Insert into awbl
				$data_1=array(
				'awb_number'	=> $addawbl,
				'status'		=> '1');
				$data_1 = array_merge($data_1, sigco_traceur()); // tracabilite creation (Bloc 03)
				$this->db->insert('awbl', $data_1);

				// Set Awbl to WareHouse
				$data_2=array(
				'no_awbl'		=> $addawbl,
				'idcompagnie'	=> $compagnie);

				$this->db->where('no_warehouse', $no_warehouse);
				$this->db->update('warehouse', $data_2);

				// Insert into buil
				$data_3=array(
				'awbl'		=> $addawbl,
				'segmentid'	=> $compagnie,
				'typeawbl'	=> 'export');
				$this->db->insert('buil', $data_3);

				$datapmt[0]=array(
				'idtx'				=>date('YmdHis'),
				'codetx'			=>'FAC',
				'date'				=>date('y-m-d'),
				'description'		=>'Default_export',
				'apayer'			=>'1',
				'monnaie_apayer' 	=>'USD',
				'payer'				=>'1',
				'taux'				=>'',
				'encaisse'			=>'',
				'monnaie'			=>'',
				'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
				'nopaiement'		=>'',
				'status'			=>'1',
				'awbl_type'    		=> "export",
				'norapport'			=>$this->session->numrapport,
				'awbl'				=>$addawbl
				);
				// $this->db->insert('tbl_facture',$datapmt);
				//
				//
				// return true;
				$datapmt[1]=array(
				'idtx'				=>date('YmdHis').valeur_n_chiffres(1,0),
			 'codetx'			=>'FAC',
			 'date'				=>date('y-m-d'),
			 'description'		=>'Other charges due agent',
			 'apayer'			=>'0',
			 'monnaie_apayer' 	=>'USD',
			 'payer'				=>'0',
			 'taux'				=>'',
			 'encaisse'			=>'',
			 'monnaie'			=>'',
			 'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
			 'nopaiement'		=>'',
			 'status'			=>'1',
			 'awbl_type'    		=> "export",
			 'norapport'			=>$this->session->numrapport,
			 'awbl'				=>$addawbl
			 );

			$datapmt[2]=array(
			 'idtx'				=>date('YmdHis').valeur_n_chiffres(2,0),
			'codetx'			=>'FAC',
			'date'				=>date('y-m-d'),
			'description'		=>'Other charges due carrier',
			'apayer'			=>'0',
			'monnaie_apayer' 	=>'USD',
			'payer'				=>'0',
			'taux'				=>'',
			'encaisse'			=>'',
			'monnaie'			=>'',
			'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
			'nopaiement'		=>'',
			'status'			=>'1',
			'awbl_type'    		=> "export",
			'norapport'			=>$this->session->numrapport,
			'awbl'				=>$addawbl
			);
			$datapmt[3]=array(
		 'idtx'				=>date('YmdHis').valeur_n_chiffres(3,0),
		'codetx'			=>'FAC',
		'date'				=>date('y-m-d'),
		'description'		=>'Weight charge',
		'apayer'			=>'0',
		'monnaie_apayer' 	=>'USD',
		'payer'				=>'0',
		'taux'				=>'',
		'encaisse'			=>'',
		'monnaie'			=>'',
		'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
		'nopaiement'		=>'',
		'status'			=>'1',
		'awbl_type'    		=> "export",
		'norapport'			=>$this->session->numrapport,
		'awbl'				=>$addawbl
		);

		$query = $this->db->insert_batch('tbl_facture', $datapmt);
		return $query;

				}
				public function creation_bill_export2($awb_bycomp,$no_warehouse,$compagnie){

					// Insert into awbl
					$data_1=array(
					'awb_number'	=> $awb_bycomp,
					'status'		=> '1');
					$data_1 = array_merge($data_1, sigco_traceur()); // tracabilite creation (Bloc 03)
					$this->db->insert('awbl', $data_1);
	
					// Set Awbl to WareHouse
					$data_2=array(
					'no_awbl'		=> $awb_bycomp,
					'idcompagnie'	=> $compagnie);
	
					$this->db->where('no_warehouse', $no_warehouse);
					$this->db->update('warehouse', $data_2);
	
						$data_4=array(
						'date_out'		=> date('Y-m-d H:i:s'),
						'statut'		=> '1');
		
						$this->db->where('awb',  $awb_bycomp);
						$this->db->update('awb_by_compagnie', $data_4);
		



					// Insert into buil
					$data_3=array(
					'awbl'		=> $awb_bycomp,
					'segmentid'	=> $compagnie,
					'typeawbl'	=> 'export');
					$this->db->insert('buil', $data_3);
	
					$datapmt[0]=array(
					'idtx'				=>date('YmdHis'),
					'codetx'			=>'FAC',
					'date'				=>date('y-m-d'),
					'description'		=>'Default_export',
					'apayer'			=>'1',
					'monnaie_apayer' 	=>'USD',
					'payer'				=>'1',
					'taux'				=>'',
					'encaisse'			=>'',
					'monnaie'			=>'',
					'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
					'nopaiement'		=>'',
					'status'			=>'1',
					'awbl_type'    		=> "export",
					'norapport'			=>$this->session->numrapport,
					'awbl'				=>$awb_bycomp
					);
					// $this->db->insert('tbl_facture',$datapmt);
					//
					//
					// return true;
					$datapmt[1]=array(
					'idtx'				=>date('YmdHis').valeur_n_chiffres(1,0),
				 'codetx'			=>'FAC',
				 'date'				=>date('y-m-d'),
				 'description'		=>'Other charges due agent',
				 'apayer'			=>'0',
				 'monnaie_apayer' 	=>'USD',
				 'payer'				=>'0',
				 'taux'				=>'',
				 'encaisse'			=>'',
				 'monnaie'			=>'',
				 'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
				 'nopaiement'		=>'',
				 'status'			=>'1',
				 'awbl_type'    		=> "export",
				 'norapport'			=>$this->session->numrapport,
				 'awbl'				=>$awb_bycomp
				 );
	
				$datapmt[2]=array(
				 'idtx'				=>date('YmdHis').valeur_n_chiffres(2,0),
				'codetx'			=>'FAC',
				'date'				=>date('y-m-d'),
				'description'		=>'Other charges due carrier',
				'apayer'			=>'0',
				'monnaie_apayer' 	=>'USD',
				'payer'				=>'0',
				'taux'				=>'',
				'encaisse'			=>'',
				'monnaie'			=>'',
				'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
				'nopaiement'		=>'',
				'status'			=>'1',
				'awbl_type'    		=> "export",
				'norapport'			=>$this->session->numrapport,
				'awbl'				=>$awb_bycomp
				);
				$datapmt[3]=array(
			 'idtx'				=>date('YmdHis').valeur_n_chiffres(3,0),
			'codetx'			=>'FAC',
			'date'				=>date('y-m-d'),
			'description'		=>'Weight charge',
			'apayer'			=>'0',
			'monnaie_apayer' 	=>'USD',
			'payer'				=>'0',
			'taux'				=>'',
			'encaisse'			=>'',
			'monnaie'			=>'',
			'nofacture'			=>date('YmdHis').valeur_n_chiffres(5,0),
			'nopaiement'		=>'',
			'status'			=>'1',
			'awbl_type'    		=> "export",
			'norapport'			=>$this->session->numrapport,
			'awbl'				=>$awb_bycomp
			);
	
			$query = $this->db->insert_batch('tbl_facture', $datapmt);
			return $query;
	
					}
				public function Other_charges_due_agent($id)
				{
				$this->db->where('awbl', $id);
				$this->db->where('description', 'Other charges due agent');
				$query = $this->db->get('tbl_facture');
				return $query->result();
				}

				public function Other_charges_due_carrier($id)
				{
				$this->db->where('awbl', $id);
				$this->db->where('description', 'Other charges due carrier');
				$query = $this->db->get('tbl_facture');
				return $query->result();
				}
				public function give_num_no_warehouse()
				{
				$i=1;
				$trouve = 1;
				$code = date('dmy').$i;
				$this->db->where('no_warehouse', $code);
				$query = $this->db->get('warehouse');

				while($query->num_rows()){
				$i++;
				$code = date('dmy').$i;
				$this->db->where('no_warehouse', $code);
				// $this->db->where('awbl_type', 'import');
				$query = $this->db->get('warehouse');
				}

				return $code;
				}

				public function Weight_charge($id)
				{
				$this->db->where('awbl', $id);
				$this->db->where('description', 'Weight charge');
				$query = $this->db->get('tbl_facture');
				return $query->result();
				}
				public function update_batch_tbl_facture($data)
				{
				$query = $this->db->update_batch('tbl_facture', $data, 'idtx');
				return $query;
				}
				// public function update_Other_charges_due_agent($id,$data,$id2)
				// {
				// 	$this->db->where('awbl', $id);
				// $this->db->where('idtx', $id2);
				// $this->db->update('tbl_facture', $data);
				// return $query;
				// }
				//
				// 				public function update_Other_charges_due_carrier($id,$data,$id2)
				// 				{
				// 					$this->db->where('awbl', $id);
				// 				$this->db->where('idtx', $id2);
				// 				$this->db->update('tbl_facture', $data);
				// 				return $query;
				// 				}
				//
				// 				public function update_Weight_charge($id,$data,$id2)
				// 				{
				// 					$this->db->where('awbl', $id);
				// 				$this->db->where('idtx', $id2);
				// 				$this->db->update('tbl_facture', $data);
				// 				return $query;
				// 				}
				
			
			
				public function delete_awb_tblAWBL($id)
				{
				$this->db->where('awb_number', $id);
				$query = $this->db->delete('awbl');

				return $query;
				}

				public function delete_awb_tblBuil($id)
				{
				$this->db->where('awbl', $id);
				$this->db->where('typeawbl', 'export');
				$query = $this->db->delete('buil');

				return $query;
				}
				public function delete_awb_tblfacture($id)
				{
				$this->db->where('awbl', $id);
				$this->db->where('awbl_type', 'export');
				$query = $this->db->delete('tbl_facture');

				return $query;
				}
				public function update_awb_by_compagnie ($id,$data)
				{
				$this->db->where('awb', $id);
				$this->db->update('awb_by_compagnie', $data);
				return $query;
				}
				public function update_awb_warehouse ($id,$data2)
				{
				$this->db->where('no_awbl', $id);
				$this->db->update('warehouse', $data2);
				return $query;
				}

				public function get_all_info_tag($id)
				{

				$sql="SELECT ANY_VALUE(awbl.awb_number) AS `awb_number`, ANY_VALUE(awbl.commdity_item_no) AS `commdity_item_no`, ANY_VALUE(awbl.route_to1) AS `route_to1`, ANY_VALUE(awbl.route_first_carrier) AS `route_first_carrier`, ANY_VALUE(awbl.flight) AS `flight`, ANY_VALUE(awbl.date_flight) AS `date_flight`, ANY_VALUE(awbl.route_to2) AS `route_to2`, ANY_VALUE(awbl.route_by1) AS `route_by1`, ANY_VALUE(warehouse.gross_weight) AS `gross_weight`, ANY_VALUE(warehouse.no_warehouse) AS `no_warehouse`, sum(warehouse_colis.no_pieces) as pieces
					 FROM awbl
				INNER JOIN warehouse ON (warehouse.no_awbl = awbl.awb_number) 
				INNER JOIN warehouse_colis ON (warehouse_colis.id_warehouse=warehouse.no_warehouse) 
				where awbl.awb_number=? ";
				$query = $this->db->query($sql, array($id));
				return $query->result();
				}

				// ----------------------------------------------------------------
				// Bloc 03 - Points de chargement (Point of Loading) dynamiques.
				// ----------------------------------------------------------------
				public function get_points_of_loading($actifs_seulement = TRUE)
				{
				if ($actifs_seulement)
				{
				$this->db->where('statut', 1);
				}
				$this->db->order_by('nom', 'ASC');
				return $this->db->get('point_of_loading')->result();
				}

				public function point_actif($code)
				{
				$ligne = $this->db->where('code', (string) $code)->where('statut', 1)
					->limit(1)->get('point_of_loading')->row();
				return $ligne ? $ligne : NULL;
				}

				public function add_point_of_loading($data)
				{
				return $this->db->insert('point_of_loading', $data);
				}

				public function compter_points_of_loading()
				{
				return (int) $this->db->count_all('point_of_loading');
				}

				public function get_points_of_loading_page($limit, $offset)
				{
				$this->db->order_by('nom', 'ASC');
				return $this->db->get('point_of_loading', (int) $limit, (int) $offset)->result();
				}

				// ----------------------------------------------------------------
				// Bloc 03 - Zone d'archives des numeros d'AWB.
				// ----------------------------------------------------------------
				public function get_un_awbl_par_id($id)
				{
				return $this->db->where('id_awbl', (int) $id)->limit(1)->get('awbl')->row();
				}

				/**
				 * Archive une ligne awbl vers awbl_archive puis libere le numero
				 * (suppression de la ligne active), le tout dans une transaction.
				 * @return bool  TRUE si l'archivage a reussi.
				 */
				public function archiver_awbl($id, $archiveur, $motif = '')
				{
				$awbl = $this->get_un_awbl_par_id($id);
				if ( ! $awbl)
				{
				return FALSE;
				}
				$ligne = (array) $awbl;
				unset($ligne['id_awbl']); // id_archive est propre a la table d'archives
				$ligne['archive_par_id']  = isset($archiveur['id']) ? $archiveur['id'] : '';
				$ligne['archive_par_nom'] = isset($archiveur['nom']) ? $archiveur['nom'] : '';
				$ligne['archive_le']      = isset($archiveur['le']) ? $archiveur['le'] : date('Y-m-d H:i:s');
				$ligne['motif']           = (string) $motif;

				$this->db->trans_start();
				$this->db->insert('awbl_archive', $ligne);
				$this->db->where('id_awbl', (int) $id)->delete('awbl');
				$this->db->trans_complete();

				return $this->db->trans_status();
				}

				public function compter_awbl_archive($recherche = '')
				{
				if ($recherche !== '')
				{
				$this->db->like('awb_number', $recherche);
				}
				return (int) $this->db->count_all_results('awbl_archive');
				}

				public function get_awbl_archive_page($recherche, $limit, $offset)
				{
				if ($recherche !== '')
				{
				$this->db->like('awb_number', $recherche);
				}
				$this->db->order_by('archive_le', 'DESC')->order_by('id_archive', 'DESC');
				return $this->db->get('awbl_archive', (int) $limit, (int) $offset)->result();
				}

				public function get_un_awbl_archive($id)
				{
				return $this->db->where('id_archive', (int) $id)->limit(1)->get('awbl_archive')->row();
				}
			}


				?>
