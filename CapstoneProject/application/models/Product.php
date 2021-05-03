<?php
class Product extends MY_Model{

    
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "products";
    }

    public function get(){
        return $this->db->get($this->table_name)->result();
    }

    public function get_similar($id){
        return  $this->db->limit(5)->get_where($this->table_name,array('category_id'=>$id))->result();
    }
    public function paginate_get($offset,$num_page){
        return $this->db->limit($num_page,$offset)->get($this->table_name)->result();
    }

    public function find($id){
        return $this->db->get_where($this->table_name,array('id'=>$id))->row();
    }

    public function create($arr){
       
        $main_image = $arr["images"][$arr["main_image"]];
        unset($arr["images"][$arr["main_image"]]);
        

    //    echo json_encode(array_values($arr["images"]));
    //     die;

       $data = array(
        'name'=>$arr["name"],
        'description'=>$arr["description"],
        'price'=>$arr["price"],
        'category_id'=>$arr["category_id"],
        'stocks'=>$arr["stocks"],
        'images'=>json_encode(array(
            'main'=>$main_image,
            'subs'=>array_values($arr["images"])
        ))
       );

       $this->db->insert($this->table_name,$data);
       return $this->db->insert_id();
    }

    public function create_validation(){
        return array(


        );
    }

}