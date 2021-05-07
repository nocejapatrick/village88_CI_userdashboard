<?php
class Products extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("User");
        $this->load->model("Category");
        $this->load->model("Product");
    }

    public function index($page = 1){
        // $this->session->unset_userdata('cart');

        $no_of_records_per_page = 12;
        $offset = ($page-1) * $no_of_records_per_page; 

    
        
        $products = $this->Product->paginate_get($offset,$no_of_records_per_page);

        $total_pages = ceil(count($this->Product->get())/$no_of_records_per_page);


        $categories = $this->Category->get_products_categories();
        $this->load->view('templates/shop/index',array('products'=>$products,'categories'=>$categories,'total_pages'=>$total_pages,'category_id'=>0,'current_page'=>$page));
    }

    public function categories($category_id= 0, $page = 1){
        
        $no_of_records_per_page = 12;
        $offset = ($page-1) * $no_of_records_per_page; 

       
        
        $products = $this->Product->paginate_get($offset,$no_of_records_per_page,$category_id);

        $total_pages = ceil(count($this->Product->get_products_per_cat($category_id))/$no_of_records_per_page);

        $categories = $this->Category->get_products_categories();
        $this->load->view('templates/shop/index',array('products'=>$products,'categories'=>$categories,'total_pages'=>$total_pages,'category_id'=>$category_id,'current_page'=>$page));
    }

    public function category($cat_id){
        $products = $this->Product->get();
        $categories = $this->Category->get_products_categories();
        $this->load->view('templates/shop/index',array('products'=>$products,'categories'=>$categories));
    }

    // Show my Product Details
    public function show($id){
        $product = $this->Product->find($id);
        $prod_cat = $product->category_id;
        $similar = $this->Product->get_similar($prod_cat,$id);
        $product_reviews = $this->Product->get_reviews($id);
        $this->load->view('templates/shop/product_detail',array('product'=>$product,'similar'=>$similar,'product_reviews'=>$product_reviews));
    }

    // Diplays Cart Page
    public function cart(){
        $this->load->view('templates/shop/cart');
    }


    // This is my function to create my product and edit it
    public function create(){
        $products = $this->input->post(null,true);
        $is_edit = filter_var($products["is_edit"], FILTER_VALIDATE_BOOLEAN);
        

        $number_of_files_uploaded = count($_FILES['files']['name']);
        $fileNames = [];

        if(!$is_edit){
            if ($number_of_files_uploaded > 4){ 
                $message['message'] = "You can upload 4 Images";
                $this->return_json($message);
            }else{
    
                for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
                    $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
                    $fileNames[] = $this->Product->generate_rand(12).'.'.explode("/", $_FILES['files']['type'][$i])[1];
                }
            
                $products["images"] = $fileNames;
    
                $latest_id = $this->Product->create($products);
    
                mkdir('./assets/images/products/' .$latest_id , 0777, TRUE);
    
    
                $imagePath = realpath('./assets/images/products/'.$latest_id.'/');
    
            
                for ($i = 0; $i <  $number_of_files_uploaded; $i++) {
                    $_FILES['userfile']['name']     = $_FILES['files']['name'][$i];
                    $_FILES['userfile']['type']     = $_FILES['files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $_FILES['files']['error'][$i];
                    $_FILES['userfile']['size']     = $_FILES['files']['size'][$i];
    
                    $config = array(
                        'file_name'     => $fileNames[$i],
                        'allowed_types' => 'jpg|jpeg|png|gif',
                        'upload_path'   =>$imagePath
                    );
                    $this->upload->initialize($config);
                    $errCount = 0;//counting errrs
                    if (!$this->upload->do_upload('userfile'))
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $errors[] = array(
                            'errors'=> $error
                        );
                        // $this->return_json($errors);
                    }
                    else
                    {
                        $filename = $this->upload->data();
                      
                 
                    }
                    
                }
    
            }
         
    
            // $message["message"]= "Successfully Added";
            // $this->return_json($message);
        }else{
            $product = $this->Product->update($products);
        }
     
    }


    // get JSON response get categories
    public function api_get(){
        $data = array(
            "response"=>200,
            "categories"=>$this->get()
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
     
    // This is my add to cart product in session function
    public function add_to_cart(){
        // $this->session->unset_userdata('cart');
        $product = $this->input->post(null,true);
        $product["product_id"] = (int) $product["product_id"];
        $product["quantity"] = (int) $product["quantity"];

        $db_prod = $this->Product->find($product["product_id"]);

        $product["name"] = $db_prod->name;
        $product["price"] = (float)$db_prod->price;


        $cart = ($this->session->userdata('cart')) ? $this->session->userdata('cart') : [];

        $isProd = false;

        $totalQuantity = 0;

        for($i = 0; $i < count($cart); $i++){
            if($cart[$i]["product_id"] == $product["product_id"]){
                if(isset($product["from_cart"])){
                    $cart[$i]["quantity"] = $product["quantity"];
                }else{
                    $cart[$i]["quantity"] = $cart[$i]["quantity"] + $product["quantity"];
                }
           
                $isProd = true;
            }
        } 

        if(!$isProd){
            $cart[] = $product;
        }
        
        for($i = 0; $i < count($cart); $i++){
            $totalQuantity += $cart[$i]["quantity"];
        } 

        $this->session->set_userdata('cart',$cart);

        $message["cart_items_count"] = $totalQuantity;
        $this->return_json($message);
    }


    


    public function delete_to_cart(){
        // $this->session->unset_userdata('cart');

        $product_id = (int)$this->input->post(null,true)["product_id"];


        $cart = $this->session->userdata('cart');

     

        for($i = 0; $i < count($cart); $i++){
            if($cart[$i]["product_id"] == $product_id){
          
                array_splice($cart,$i,1);
            }
        } 

      
        $totalQuantity = 0;
        
        for($i = 0; $i < count($cart); $i++){
            $totalQuantity += $cart[$i]["quantity"];
        } 




        $this->session->set_userdata('cart',$cart);

        $message["cart_items_count"] = $totalQuantity;
        $message["cart_items"] = $cart;
        $this->return_json($message);
    }


    public function pay(){
        $info = $this->input->post(null,true);


        $store = array();
        if(isset($info["same_as_shipping"])){
            $store = array(
                "shipping_information"=> array(
                    "first_name"=> $info["shipping_first_name"],
                    "last_name"=> $info["shipping_last_name"],
                    "address" => $info["shipping_address"],
                    "address2" => $info["shipping_address_2"],
                    "city"=>$info["shipping_city"],
                    "state"=>$info["shipping_state"],
                    "zipcode"=>$info["shipping_zipcode"]
                )
            );
        }else{
            $store = array(
                "shipping_information"=> array(
                    "first_name"=> $info["shipping_first_name"],
                    "last_name"=> $info["shipping_last_name"],
                    "address" => $info["shipping_address"],
                    "address2" => $info["shipping_address_2"],
                    "city"=>$info["shipping_city"],
                    "state"=>$info["shipping_state"],
                    "zipcode"=>$info["shipping_zipcode"]
                ),
                "billing_information"=> array(
                    "first_name"=> $info["billing_first_name"],
                    "last_name"=> $info["billing_last_name"],
                    "address" => $info["billing_address"],
                    "address2" => $info["billing_address_2"],
                    "city"=>$info["billing_city"],
                    "state"=>$info["billing_state"],
                    "zipcode"=>$info["billing_zipcode"]
                )
            );
        }

        $insert_order = $this->Product->insert_orders($store);
        redirect(base_url()."/products/pay_success");
    }

    public function pay_success(){
        $this->load->view("templates/shop/pay_success");
    }

    public function add_review(){
        $product = $this->input->post(null,true);

        $this->Product->add_review($product);

        redirect(base_url()."/products/show/".$product["product_id"]);
    }

    public function get_product_detail($id){
        $product = $this->Product->find_w_category($id);

        $data["data"] = $product;
        $this->return_json($product);
    }

    public function get(){
        return $this->Product->get();
    }
}