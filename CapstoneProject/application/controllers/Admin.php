<?php
class Admin extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Product");
    }

    public function index(){
        $this->load->view('templates/admin/signin');
    }

    public function orders(){
        $this->user_logged_in();
        $this->load->view('templates/admin/orders');
    }

    public function products($page=1){
        $no_of_records_per_page = 5;
        $offset = ($page-1) * $no_of_records_per_page; 

        $total_pages = ceil(count($this->Product->get())/$no_of_records_per_page);
        
        $products = $this->Product->paginate_get($offset,$no_of_records_per_page);
        $this->load->view('templates/admin/products',array('products'=>$products,'total_pages'=>$total_pages));
    }

    // public function products_page($page=1){
    //     $no_of_records_per_page = 5;
    //     $offset = ($page-1) * $no_of_records_per_page; 

    //     $total_pages = ceil(count($this->Product->get())/$no_of_records_per_page);
        
    //     $products = $this->Product->paginate_get($offset,$no_of_records_per_page);
    //     $this->load->view('templates/admin/products',array('products'=>$products,'total_pages'=>$total_pages,'page'=>$page));
    // }
}