<?php
class Order extends MY_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table_name = "orders";
    }

    public function get(){
        return $this->db->get($this->table_name)->result();
    }

    
    public function get_orders_w_total($num_page,$offset,$user_id = null){
        if($user_id == null){
            $this->db->select("orders.id, orders.ordered_at as ordered_at, orders.status as status, orders.addresses_information AS addresses_information, FORMAT(SUM(products.price * orders_products.quantity),2) AS total");
            $this->db->from("orders");
            $this->db->join("orders_products","orders.id = orders_products.order_id");
            $this->db->join("products","orders_products.product_id = products.id");
            $this->db->group_by("orders.id");
            $this->db->order_by("orders.id","DESC");


            return $this->db->limit($num_page,$offset)->get()->result();
        }else{
            $this->db->select("orders.id, orders.ordered_at as ordered_at, orders.status as status, orders.addresses_information AS addresses_information, FORMAT(SUM(products.price * orders_products.quantity),2) AS total");
            $this->db->from("users_orders");
            $this->db->join("orders","users_orders.order_id = orders.id");
            $this->db->join("orders_products","orders.id = orders_products.order_id");
            $this->db->join("products","orders_products.product_id = products.id");
            $this->db->where('users_orders.user_id',$user_id);
            
            $this->db->group_by("orders.id");

            $this->db->order_by("orders.id","DESC");
            
            return $this->db->limit($num_page,$offset)->get()->result();
        }
      
      }

      public function update($status){
        $this->db->where('id', $status["order_id"]);
        $this->db->update($this->table_name,array("status"=>$status["status"]));
      }

      public function find($id){
          return $this->db->get_where($this->table_name,array('id'=>$id))->row();
      }

      public function get_detail_order($order_id){
          $order = $this->find($order_id);
          $this->db->select("products.*, orders_products.quantity as quantity");
          $this->db->from("products");
          $this->db->join("orders_products","products.id = orders_products.product_id");
          $this->db->where("orders_products.order_id",$order_id);
          $this->db->group_by("orders_products.id");
          $products = $this->db->get()->result();
          $order->products = $products;
          return $order;
      }
}