<?php
class Orders extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Order");
    }

    public function index($page = 1){
        $this->user_logged_in();

        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page; 

        $user = $this->session->userdata("user");
      
        
        $orders = $this->Order->get_orders_w_total($no_of_records_per_page,$offset,$user->id);

        $total_pages = ceil(count($this->Order->get())/$no_of_records_per_page);



        // $orders = $this->Order->get_orders_w_total(2,0);

        $this->load->view('templates/users/orders',array('orders'=>$orders,'total_pages'=>$total_pages));
    }

    public function show($id){
        $this->load->view('templates/admin/order_detail');
    }
   
}