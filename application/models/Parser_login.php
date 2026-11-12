<?php
require_once APPPATH."/third_party/ctools.php";

class Parser_login extends CI_Model
{
	public function __construct(){

	}

	public function sign_in($user, $motdepasse)
	{
		$this->db->where('uadmin', $user);
		$this->db->where('mpasse', $motdepasse);
		$this->db->where('letat', '1');
		$query = $this->db->get('entreprise');
		return $query->result();
	}

	public function sign_groupe($idgroupe)
	{
		$this->db->where('idgroupe_user', $idgroupe);
		$query = $this->db->get('groupe_user');
		return $query->result();
	}

}
?>
