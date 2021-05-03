<?php
class Orders extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function show($id){
        $this->load->view('templates/admin/order_detail');
    }
   
}