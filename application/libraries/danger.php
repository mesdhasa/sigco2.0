 //function that allow upload file
    public function uploadFile($file,$path,$size,$filetype,$filename){
            //$config['upload_path'] = './public/images/'.$path.'/';
            $config['upload_path'] =$path;
            $config['allowed_types'] =$filetype;
            $config['max_size'] =$size;
            $config['max_width']  = 0;
            $config['max_height']  = 0;
						$config['file_name'] = $filename;
            $this->api->load->library('upload', $config);
            if (!$this->api->upload->do_upload($file)){ return false;}
            else{return $this->api->upload->data();}
    }
    //end of updating
    //try to enable a table
    function enabled($table,$model){
        $model=$model.'Model';
        $id = ($this->api->uri->segment(3)) ? $this->api->uri->segment(3) : '';
        $page = ($this->api->uri->segment(4)) ? $this->api->uri->segment(4) : 0;
        $is=$this->api->$model->Enabled($id,$table);
        if($is){
                  $message = array('message' => 'Enabled with success','class' => 'warning');
                  $this->api->session->set_flashdata('info',$message);
                  return $page;
        }else{
                  $message = array('message' => 'We have an error, please contact your webmaster!','class' => 'danger');
                  $this->api->session->set_flashdata('info',$message);
                  return $page;
        }

    }
    //try to desabled a table
    function disabled($table,$model){
        $model=$model.'Model';
        $id = ($this->api->uri->segment(3)) ? $this->api->uri->segment(3) : '';
        $page = ($this->api->uri->segment(4)) ? $this->api->uri->segment(4) : 0;
        $is=$this->api->$model->Disabled($id,$table);
        if($is){
                  $message = array('message' => 'Desabled with success','class' => 'warning');
                  $this->api->session->set_flashdata('info',$message);
                  return $page;
        }else{
                  $message = array('message' => 'We have an error, please contact your webmaster!','class' => 'danger');
                  $this->api->session->set_flashdata('info',$message);
                  return $page;
        }
    }
    //*********************************************************************
    //*********************************************************************
    public function Post($data){
        $i=0;
        $array=array();
        for ($i=0; $i <count($data) ; $i++) {
            if($data[$i]=='password'){
                $array[$data[$i]]=$this->api->encryption->encrypt(($this->api->input->post($data[$i])));
            }else{
               $array[$data[$i]]=$this->api->input->post($data[$i]);
            }

        }
        return $array;
    }
    //*********************************************************************
    //*********************************************************************
    public function Rules($data){
        $this->form_validation->set_rules('title', 'title', 'required');
        $i=0;
        for ($i=0; $i <count($data) ; $i++) {
            $this->api->form_validation->set_rules($data[$i],$data[$i],'required');
        }
    }
    //*********************************************************************
    //*********************************************************************
    public function Danger($controller,$sms="Sorry we have an error, contact webmaster"){
            $message = array('message' =>$sms,'class' => 'danger');
            $this->api->session->set_flashdata('info',$message);
            redirect($controller, 'refresh');
    }
    //*********************************************************************
    //*********************************************************************
    public function Success($controller,$message){
            $message = array('message' => $message.' with success','class' => 'success');
            $this->api->session->set_flashdata('info',$message);
            redirect($controller, 'refresh');
    }    //*********************************************************************
    //*********************************************************************
    public function sms($controller,$sms,$class){
            $message = array('message' => $sms,'class' =>"{$class}");
            $this->api->session->set_flashdata('info',$message);
            redirect($controller, 'refresh');
    }
    //*********************************************************************
    public function flash($sms,$class){
            $message = array('message' => $sms,'class' =>"{$class}");
            $this->api->session->set_flashdata('info',$message);
    }
    //*********************************************************************
    //*********************************************************************
        //*********************************************************************
    //*********************************************************************
    public function MSG($controller,$message){
            $message = array('message' => $message,'class' => 'success');
            $this->api->session->set_flashdata('info',$message);
            redirect($controller, 'refresh');
    }
    //*********************************************************************
    //*********************************************************************
    public function fail_file($file,$size,$filetype){
        $message = array(
          'message'=>"Le champ file({$file}) permet seulement extension: {$filetype} maximun size {$size}kb.",
            'class' => 'danger');
        $this->api->session->set_flashdata('info',$message);
    }
    //*********************************************************************
    //*********************************************************************

        //try to enable a table
    function delete($table,$model){
        $model=$model.'_model';
        $id = ($this->api->uri->segment(3)) ? $this->api->uri->segment(3) : '';
        $is=$this->api->$model->Delete($id,$table);
        if($is){
                  $message = array('message' => 'Deleted with success','class' => 'success');
                  $this->api->session->set_flashdata('info',$message);
        }else{
                  $message = array('message' => 'We have an error, please contact your webmaster!','class' => 'danger');
                  $this->api->session->set_flashdata('info',$message);
        }

    }
    /*
        *
    */
    // generate key 14 length
    public function createKey($str=null){
      return $str.date('YmdHis');
    }
    // generate key 14 length

    public function random($length) {
        $key = '';
        $keys = array_merge(array_merge(range(0, 9), range('a', 'z')),range('A', 'Z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
//'Y-m-d\TH:i:s'