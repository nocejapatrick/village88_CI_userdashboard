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
    public function get_products_per_cat($cat_id){
        return $this->db->get_where($this->table_name,array("category_id"=>$cat_id))->result();
    }
    public function get_similar($cat_id,$prod_id){
        return  $this->db->limit(5)->get_where($this->table_name,array('category_id'=>$cat_id,'id !='=>$prod_id))->result();
    }
    public function paginate_get($offset,$num_page,$category_id = null){
        if($category_id == null){
            return $this->db->limit($num_page,$offset)->get($this->table_name)->result();
        }else{
            return $this->db->limit($num_page,$offset)->get_where($this->table_name,array("category_id"=>$category_id))->result();
        }
     
    }

    public function find($id){
        return $this->db->get_where($this->table_name,array('id'=>$id))->row();
    }

    public function find_w_category($id){

        $this->db->select("products.*, categories.name as cat_name, categories.id as cat_id");
        $this->db->from("products");
        $this->db->join("categories","categories.id = products.category_id");
        $this->db->where('products.id',$id);

        return $this->db->get()->row();
    }

    public function create($arr){
       
        $main_image = $arr["images"][$arr["main_image"]];
        unset($arr["images"][$arr["main_image"]]);
   
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

    public function insert_orders($store){
        $user = $this->session->userdata('user');
        $products = $this->session->userdata('cart');

        $ord = array(
            "addresses_information"=>json_encode($store)
        );
        $order = $this->db->insert("orders",$ord);

        $order_id = $this->db->insert_id();

        foreach($products as $product){
            $order_products = array(
                "order_id"=>$order_id,
                "product_id"=>$product["product_id"],
                "quantity"=>$product["quantity"]
            );

            $this->db->insert("orders_products",$order_products);
        }

        if($user){
   
            $user_order = array(
                "user_id"=>$user->id,
                "order_id"=>$order_id
            );
            $order_user = $this->db->insert("users_orders",$user_order);

        }

        $this->session->set_userdata('cart',[]);
    }

    public function get_reviews($id){

        $this->db->select("CONCAT(users.first_name,' ',users.last_name) AS name, products_reviews.review AS review, products_reviews.created_at AS created_at");
        $this->db->from("products_reviews");
        $this->db->join("users","users.id = products_reviews.user_id ");
        $this->db->where('products_reviews.product_id',$id);
        return $this->db->get()->result();
    }

    // Add a review for my products

    public function add_review($product){
        $user = $this->session->userdata('user');
        $product_review = array(
            'user_id'=>$user->id,
            'product_id'=>$product["product_id"],
            'review'=>$product["review"]
        );
        $this->db->insert("products_reviews",$product_review);
    }

    // Updating Product
    public function update($arr){
       $data = array(
        'name'=>$arr["name"],
        'description'=>$arr["description"],
        'price'=>$arr["price"],
        'category_id'=>$arr["category_id"],
        'stocks'=>$arr["stocks"],
       );

       $this->db->where('id', $arr["product_id"]);
       $this->db->update($this->table_name,$data);
    }
  

}