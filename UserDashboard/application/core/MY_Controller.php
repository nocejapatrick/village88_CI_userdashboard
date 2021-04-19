<?php
class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    function _output($content)
    {
        $data['content'] = &$content;
        echo($this->load->view('base', $data, true));
    }

    public function error_arrays($errs){
        foreach($errs as $key=>$value){
            $this->session->set_flashdata($key.'_error',$value);
        }
    }
}