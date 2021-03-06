<?php
class Admin extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Product");
        $this->load->model("Order");
    }

    public function index(){
        $this->load->view('templates/admin/signin');
    }

    // Admin Page Orders
    public function orders($page = 1){
        $this->user_logged_in();

        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page; 
   
        
        $orders = $this->Order->get_orders_w_total($no_of_records_per_page,$offset);

        $total_pages = ceil(count($this->Order->get())/$no_of_records_per_page);

        $this->load->view('templates/admin/orders',array('orders'=>$orders,'total_pages'=>$total_pages));
    }

    // Admin Page Order Details

    public function orders_details($id){
        $order = $this->Order->get_detail_order($id);
        $this->load->view('templates/admin/order_detail',array('order'=>$order));
    }
    

    // Admin Page Products
    public function products($page=1){
        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page; 

        $total_pages = ceil(count($this->Product->get())/$no_of_records_per_page);
        
        $products = $this->Product->paginate_get($offset,$no_of_records_per_page);
        $this->load->view('templates/admin/products',array('products'=>$products,'total_pages'=>$total_pages));
    }

    public function order_update(){
        $status = $this->input->post(null,true);
        $this->Order->update($status);
        $message["message"]= "Success";
        $this->return_json($message);
        
    }
}