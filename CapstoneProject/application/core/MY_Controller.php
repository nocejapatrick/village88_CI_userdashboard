<?php
class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    // To have a template of my header, body, and footer
    function _output($content)
    {
        $data['content'] = &$content;
        echo($this->load->view('base', $data, true));
    }

    // Creating error on submit validations
    public function error_arrays($errs){
        foreach($errs as $key=>$value){
            $this->session->set_flashdata($key.'_error',$value);
        }
    }

    // return json
    public function return_json($arr){
        header('Content-Type: application/json');
        echo json_encode($arr);
        exit();
    }

    // Is User Logged in condition
    public function user_logged_in(){
        if($this->session->userdata('user') == null){
            redirect(base_url().'signin');
        }
    }
}