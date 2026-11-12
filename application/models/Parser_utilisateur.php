<?php
require_once APPPATH."/third_party/ctools.php";

class Parser_utilisateur extends CI_Model
{
	public function __construct(){

	}
	public function get_all_utilisateur()
	{
	$this->db->order_by("nompers", "ASC");
	$this->db->join('groupe_user', 'entreprise.agroupe = groupe_user.idgroupe_user','inner');
	$this->db->where('identreprise !=','001A');
	$query = $this->db->get('entreprise');
	return $query->result();
	}

	public function get_utilisateur($codeclient)
	{
	$this->db->select('*');
	$this->db->where('identreprise', $codeclient);
	$query = $this->db->get('entreprise');
	return $query->result();
	}
	public function set_a_utilisateur($utilisateur_code,$data)
	{
	$this->db->where('identreprise', $utilisateur_code);
	$this->db->update('entreprise', $data);
	return $query;
	}
	public function set_a_testuser($id2,$data)
	{
	$this->db->where('identreprise', $id2);
	$this->db->update('entreprise', $data);
	return $query;
	}
	public function set_a_password($utilisateur_code,$data)
	{
	$this->db->where('identreprise', $utilisateur_code);
	$this->db->update('entreprise', $data);
	return $query;
	}
	public function testuser($id,$passe)
	{
$this->db->select('*');
$this->db->where('identreprise', $id);
	$this->db->where('mpasse', $passe);
	$query = $this->db->get('entreprise');
	return $query->result();
	}
	// public function get_idcode()
	// {
	// 		$i=mt_rand(1,99999999);
	// 		$trouve = 1;
	// 		$code = valeur_n_chiffres($i,"8");
	//
	// 		$this->db->where('idclient', $code);
	//
	// 		$query = $this->db->get('client');
	//
	// 		while($query->num_rows()){
	// 			$i=mt_rand(1,99999999);
	// 			$code = valeur_n_chiffres($i,"8");
	//
	// 			$this->db->where('idclient', $code);
	//
	// 			$query = $this->db->get('client');
	//
	// 		}
	//
	// 		return $code;
	// }
	//

	public function ajouter($data)
	{
		$query = $this->db->insert('entreprise', $data);
		return $query;
	}

	// public function get_client($id,$parent)
	// {
	//
	// 	$this->db->where('idclient', $id);
	// 	$this->db->where('codedoralya', $parent);
	// 	$query = $this->db->get('client');
	// 	return $query->result();
	// }

	// public function modifier($id, $data)
	// {
	// 	$this->db->where('idclient', $id);
	// 	$query = $this->db->update('client', $data);
	// 	return $query;
	// }

	public function get_utilisateur_all()
	{
		$this->db->select('*');
		// $this->db->order_by("id", "DESC");
		$this->db->where('idgroupe_user !=', '0001');
		$query = $this->db->get('groupe_user');
		return $query->result();
	}

	// public function get_client_by_nom($nom,$parent)
	// {
	// 	if($nom==""){
	// 		$this->db->where('codedoralya', $parent);
	// 		$this->db->order_by('compagnie','ASC');
	// 		$query = $this->db->get('client');
	// 	}else{
	// 		$this->db->like('compagnie', $nom, 'both');
	// 		$this->db->where('codedoralya', $parent);
	// 		$this->db->order_by('compagnie','ASC');
	// 		$query = $this->db->get('client');
	// 	}
	//
	// 	return $query->result();
	// }

	// public function supprimer($id)
	// {
	// 	$this->db->where('idclient', $id);
	// 	$query = $this->db->delete('client');
	// 	return $query;
	// }

	// public function get_pays()
	// {
	// 	$this->db->order_by('nom_en_gb','ASC');
	// 	$query = $this->db->get('pays');
	// 	return $query->result();
	// }

	// public function ajouter_personne_contact($data)
	// {
	// 	$query = $this->db->insert('personne_contact', $data);
	// 	return $query;
	// }

	// public function get_personne_contact_client($id,$parent)
	// {
	// 	$this->db->order_by('nom_c','ASC');
	// 	$this->db->where('idclient', $id);
	// 	$this->db->where('codedoralya', $parent);
	// 	$query = $this->db->get('personne_contact');
	// 	return $query->result();
	// }

	// public function supprimer_personne_contact($id,$idclient,$parent)
	// {
	// 	$this->db->where('idpersonne', $id);
	// 	$this->db->where('idclient', $idclient);
	// 	$this->db->where('codedoralya', $parent);
	// 	$query = $this->db->delete('personne_contact');
	// 	return $query;
	// }

	// public function modifier_personne_contact($id,$idclient,$parent,$data)
	// {
	// 	$this->db->where('idpersonne', $id);
	// 	$this->db->where('idclient', $idclient);
	// 	$this->db->where('codedoralya', $parent);
	// 	$query = $this->db->update('personne_contact', $data);
	// 	return $query;
	// }

	public function get_idcode($parent)
	{
			$i=0;
			$trouve = 1;
			$code = valeur_n_chiffres($i,"0").$parent;

			$this->db->where('codedoralya', $parent);
			$this->db->where('identreprise', $code);

			$query = $this->db->get('entreprise');

			while($query->num_rows()){
				$i++;
				$code = valeur_n_chiffres($i,"0").$parent;

				$this->db->where('codedoralya', $parent);
				$this->db->where('identreprise', $code);

				$query = $this->db->get('entreprise');

			}

			return $code;
	}
}
?>
