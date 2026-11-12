<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class Page
{
	private $api;
	function __construct()
	{
		$this->api = & get_instance();
        $this->api->load->helper('form');
        $this->api->load->helper('url');
        $this->api->load->database();
        $this->api->load->library('pagination');
        $this->api->load->library('encryption');
	}
	//public function loadpage($table,$controller,$model,$size=5,$operation=null)
	public function loadpage($method,$model,$controller,$size=2,$total_rows)
    {
        //pagination settings
        $config['base_url'] = site_url($controller);
        $config['total_rows'] =$this->api->$model->$total_rows();
        $config['per_page'] =$size;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->api->pagination->initialize($config);
        $data['page'] = ($this->api->uri->segment(3)) ? $this->api->uri->segment(3) : 0;
        // get data list
        $data['data'] = $this->api->$model->$method($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->api->pagination->create_links();
        return $data;
    }
		//fin loadpage
	public function page($table,$controller,$model,$size=5,$operation=null)
    {
        //pagination settings
        if(is_null($operation)){ $function="get_".$table;}
        else{$function=$operation;}
        $model=$model.'Model';
        $config['base_url'] = site_url($controller.'/index');
        $config['total_rows'] = $this->api->db->count_all($table);
        $config['per_page'] =$size;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->api->pagination->initialize($config);
        $data['page'] = ($this->api->uri->segment(3)) ? $this->api->uri->segment(3) : 0;
        // get data list
        $data['data'] = $this->api->$model->$function($config["per_page"], $data['page'], NULL);

        $data['pagination'] = $this->api->pagination->create_links();
        return $data;
    }

//**//
//*Function that allow you look for some data in a table by some field*//
function searches($param,$controller,$model,$size=5,$function,$get_number)
    {

        // get search string
        $search = ($this->api->input->post($param))? $this->api->input->post($param) : "NIL";

        $search = ($this->api->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url($controller."/find/$search");
        $config['total_rows'] = $this->api->$model->$get_number($search);
        $config['per_page'] = $size;
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->api->pagination->initialize($config);

        $data['page'] = ($this->api->uri->segment(4)) ? $this->api->uri->segment(4) : 0;
        // get data list
        $data['data'] = $this->api->$model->$function($config['per_page'], $data['page'], $search);
        $data['pagination'] = $this->api->pagination->create_links();
        //load view
        return $data;
    }
//*Function that allow you look for some data in a table by some field*//
function search($param,$table,$controller,$model,$size=5,$operation=null,$total_rows)
    {
        (is_null($operation))? $function="get_".$table : $function=$operation;
        // get search string
        $search = ($this->api->input->post($param))? $this->api->input->post($param) : "NIL";

       // $search = ($this->api->uri->segment(3)) ? $this->uri->segment(3) : $search;

        // pagination settings
        $config = array();
        $config['base_url'] = site_url($controller."/recherche");
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $size;
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->api->pagination->initialize($config);

        $data['page'] = ($this->api->uri->segment(4)) ? $this->api->uri->segment(4) : 0;
        // get data list
        $data['data'] = $this->api->$model->$function($config['per_page'], $data['page'], $search);
        $data['pagination'] = $this->api->pagination->create_links();
        //load view
        return $data;
    }
//**//
//**//
    public function reload($id,$table,$controller,$model,$size=5,$operation=null)
    {
        (is_null($operation))? $function="get_".$table : $function=$operation;
        $model=$model.'Model';
        //pagination settings
        $config['base_url'] = site_url($controller.'/index');
        $config['total_rows'] = $this->api->db->count_all($table);
        $config['per_page'] = $size;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->api->pagination->initialize($config);
        $data['page'] = $id;
        // get data list
        $data['data'] = $this->api->$model->$function($config["per_page"], $data['page'], NULL);
        $data['pagination'] = $this->api->pagination->create_links();
        return $data;
    }


   
}
?>
