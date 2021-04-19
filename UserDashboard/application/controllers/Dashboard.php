<?php
class Dashboard extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("User");
    }
    public function index(){
        $this->load->view('templates/dashboard/index',array('script'=>base_url()."static/js/script.js",'users'=>$this->User->get()));
    }
}