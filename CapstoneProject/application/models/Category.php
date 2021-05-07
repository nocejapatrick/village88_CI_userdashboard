<?php
class Category extends MY_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table_name = "categories";
    }

    public function create($arr){
        $this->db->insert($this->table_name, $arr);
    }

    public function get(){
        return $this->db->get($this->table_name)->result();
    }

    public function delete($arr){
        $this->db->delete($this->table_name, array('id' => $arr["cat_id"]));
    }

 
    public function get_products_categories(){
        $this->db->select('categories.id as cat_id, count(*) as count, categories.name as cat');
        $this->db->from("products");
        $this->db->join('categories', 'categories.id = products.category_id');
        $this->db->group_by("categories.name, categories.id");
        return $this->db->get()->result();
    }
    public function update($arr){
        $this->db->where('id', $arr["cat_id"]);
        $this->db->update($this->table_name, array('name'=>$arr["name"]));
    }
}