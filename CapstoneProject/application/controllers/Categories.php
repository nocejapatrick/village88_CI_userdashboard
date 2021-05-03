<?php
class Categories extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Category");
    }
    
    public function create(){
        $category = $this->input->post(null,true);
        $this->Category->create($category);
        $data = array(
            "message"=>"Successfully Added",
            "response"=>200,
            "categories"=>$this->get()
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function api_get(){
        $data = array(
            "response"=>200,
            "categories"=>$this->get()
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function delete(){
        $cat_id = $this->input->post(null,true);
        $this->Category->delete($cat_id);

       $this->api_get();
    }

    public function update(){
        $cat= $this->input->post(null,true);
        $this->Category->update($cat);
    }

    public function get(){
        return $this->Category->get();
    }
}