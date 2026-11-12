<?php
require_once APPPATH."/third_party/ctools.php"; 

class Parser_groupe extends CI_Model
{
	public function __construct(){

	}
	
	public function get_groupe($parent)
	{
		$this->db->where('codedoralya', $parent);
		$this->db->order_by('nom_groupe','ASC');
		$query = $this->db->get('groupe_user');
		return $query->result();
	}
	
	public function get_legroupe($id, $parent)
	{
		$this->db->where('codedoralya', $parent);
		$this->db->where('idgroupe_user', $id);
		$query = $this->db->get('groupe_user');
		return $query->result();
	}
	
	public function set_groupe($data, $id, $parent)
	{
		
		$this->db->where('idgroupe_user', $id);
		$this->db->where('codedoralya', $parent);
		$query = $this->db->update('groupe_user', $data);

		return $query;
	}
	
	public function add_groupe($data)
	{
		
		$query = $this->db->insert('groupe_user', $data);

		return $query;
	}
	
	public function delete_groupe($id)
	{
		$this->db->where('idgroupe_user', $id);
		$query = $this->db->delete('groupe_user');

		return $query;
	}
	
	public function get_groupe_nom($nom, $parent)
	{
		$this->db->where('codedoralya', $parent);
		$this->db->where('nom_groupe', $nom);
		
		$query = $this->db->get('groupe_user');
		return $query->result();
	}
	
	public function get_idcode($parent)
	{
			$i=1;
			$trouve = 1;
			$code = valeur_n_chiffres($i,"3").$parent;
			
			$this->db->where('codedoralya', $parent);
			$this->db->where('idgroupe_user', $code);
		
			$query = $this->db->get('groupe_user');
			
			while($query->num_rows()){
				$i++;
				$code = valeur_n_chiffres($i,"3").$parent;
				
				$this->db->where('codedoralya', $parent);
				$this->db->where('idgroupe_user', $code);
				
				$query = $this->db->get('groupe_user');
				
			}
			
			return $code;
	}
	

}
?>