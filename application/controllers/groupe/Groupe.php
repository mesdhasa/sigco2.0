<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe extends CI_Controller {
	
	public function index()
	{
		$data['act'] 	= 'gp';
		$data['y'] 		= 'lst_gp';
		
		$data['lesgroupes'] = $this->Parser_groupe->get_groupe($_SESSION['account']['parent']);
		$data['page'] = 'groupe/groupe';
		$this->load->view('template', $data);
	}
	
	public function view()
	{
		$id 	= $this->uri->segment(2);
		$parent = $_SESSION['account']['parent']; 
		
		$data['act'] 	= 'gp';
		$data['y'] 		= 'lst_gp';
		
		$data['lesgroupes'] = $this->Parser_groupe->get_groupe($parent);	
		$data['legroupe'] 	= $this->Parser_groupe->get_legroupe($id, $parent);
		
		$data['page'] 	= 'groupe/groupe';
		$this->load->view('template', $data);
	}
	
	public function ajouter()
	{
		$data['act'] 	= 'gp';
		$data['y'] 		= 'add_gp';
		
		$data['lesgroupes'] = $this->Parser_groupe->get_groupe($this->session->codedoralya);
		$data['page'] = 'groupe/ajouter_groupe';
		$this->load->view('template', $data);
	}
	
	public function modifier()
	{
		
		$id 	= $_POST['id'];
		$parent = $_SESSION['account']['parent']; 
		
		for($i=1;$i<=100;$i++){
				if (isset($_POST['a'.$i])){
				$a[] = "1";
				}
				else{ 
				$a[] = "0";
				};
			}
	$data = array(
    'a1' => $a[0],
	'a2' => $a[1],
	'a3' => $a[2],
	'a4' => $a[3],
	'a5' => $a[4],
	'a6' => $a[5],
	'a7' => $a[6],
	'a8' => $a[7],
	'a9' => $a[8],
	'a10' => $a[9],
	'a11' => $a[10],
	'a12' => $a[11],
	'a13' => $a[12],
	'a14' => $a[13],
	'a15' => $a[14],
	'a16' => $a[15],
	'a17' => $a[16],
	'a18' => $a[17],
	'a19' => $a[18],
	'a20' => $a[19],
	'a21' => $a[20],
	'a22' => $a[21],
	'a23' => $a[22],
	'a24' => $a[23],
	'a25' => $a[24],
	'a26' => $a[25],
	'a27' => $a[26],
	'a28' => $a[27],
	'a29' => $a[28],
	'a30' => $a[29],
	'a31' => $a[30],
	'a32' => $a[31],
	'a33' => $a[32],
	'a34' => $a[33],
	'a35' => $a[34],
	'a36' => $a[35],
	'a37' => $a[36],
	'a38' => $a[37],
	'a39' => $a[38],
	'a40' => $a[39],
	'a41' => $a[40],
	'a42' => $a[41],
	'a43' => $a[42],
	'a44' => $a[43],
	'a45' => $a[44],
	'a46' => $a[45],
	'a47' => $a[46],
	'a48' => $a[47],
	'a49' => $a[48],
	'a50' => $a[49],
	'a51' => $a[50],
	'a52' => $a[51],
	'a53' => $a[52],
	'a54' => $a[53],
	'a55' => $a[54],
	'a56' => $a[55],
	'a57' => $a[56],
	'a58' => $a[57],
	'a59' => $a[58],
	'a60' => $a[59],
	'a61' => $a[60],
	'a62' => $a[61],
	'a63' => $a[62],
	'a64' => $a[63],
	'a65' => $a[64],
	'a66' => $a[65],
	'a67' => $a[66],
	'a68' => $a[67],
	'a69' => $a[68],
	'a70' => $a[69],
	'a71' => $a[70],
	'a72' => $a[71],
	'a73' => $a[72],
	'a74' => $a[73],
	'a75' => $a[74],
	'a76' => $a[75],
	'a77' => $a[76],
	'a78' => $a[77],
	'a79' => $a[78],
	'a80' => $a[79],
	'a81' => $a[80],
	'a82' => $a[81],
	'a83' => $a[82],
	'a84' => $a[83],
	'a85' => $a[84],
	'a86' => $a[85],
	'a87' => $a[86],
	'a88' => $a[87],
	'a89' => $a[88],
	'a90' => $a[89],
	'a91' => $a[90],
	'a92' => $a[91],
	'a93' => $a[92],
	'a94' => $a[93],
	'a95' => $a[94],
	'a96' => $a[95],
	'a97' => $a[96],
	'a98' => $a[97],
	'a99' => $a[98],
	'a100' => $a[99]
		);


		$this->Parser_groupe->set_groupe($data, $id, $parent);
		$this->session->set_flashdata('sms','Modification effectuée avec succès.');
				
		redirect('gestion-groupe-edit/'.$id);
	}
	
	public function ajouter_groupe()
	{
		
		$rep = $this->Parser_groupe->get_groupe_nom(trim($_POST['nom_groupe']),$_SESSION['account']['parent']);
		
		if(count($rep)>0){
			
			$this->session->set_flashdata('sms','Ce nom de groupe existe dans la base de donnée.');
				
			redirect('ajouter-un-groupe');
		}else{
			
			$id = $this->Parser_groupe->get_idcode($_SESSION['account']['parent']);
			
			$data = array(
					'idgroupe_user' => $id,
					'nom_groupe' 	=> trim($_POST['nom_groupe']),
					'cree_par' 		=> $_SESSION['account']['id'],
					'codedoralya' 	=> $_SESSION['account']['parent']
			);

			$reponse = $this->Parser_groupe->add_groupe($data);
	
			$this->session->set_flashdata('sms','Votre groupe est créé avec succès.');
				
			redirect('gestion-groupe-edit/'.$id);
		}

	}
	
	public function supprimer_groupe($id)
	{

		$reponse = $this->Parser_groupe->delete_groupe($id);
	
		$this->session->set_flashdata('sms','Votre groupe est supprimé avec succès.');
				
		redirect('gestion-groupe');
	}
	
	
}
