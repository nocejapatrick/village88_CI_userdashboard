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

    public function index(){
        $products = $this->Product->get();
        $categories = $this->Category->get_products_categories();
        $this->load->view('templates/shop/index',array('products'=>$products,'categories'=>$categories));
    }

    public function category($cat_id){
        $products = $this->Product->get();
        $categories = $this->Category->get_products_categories();
        $this->load->view('templates/shop/index',array('products'=>$products,'categories'=>$categories));
    }
    public function categories($cat_id,$page){
        $this->load->view('templates/shop/index');
    }

    public function show($id){
        $product = $this->Product->find($id);
        $prod_cat = $product->category_id;
        $similar = $this->Product->get_similar($prod_cat);
        $this->load->view('templates/shop/product_detail',array('product'=>$product,'similar'=>$similar));
    }

    public function cart(){
        $this->load->view('templates/shop/cart');
    }
    public function create(){
        $products = $this->input->post(null,true);

       


       //loading the library
      //this is your real path APPPATH means you are at the application folder
        $number_of_files_uploaded = count($_FILES['files']['name']);
        $fileNames = [];

        if ($number_of_files_uploaded > 5){ // checking how many images your user/client can upload
            $message['message'] = "You can upload 5 Images";
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
                //configuration for upload your images
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
     

        $message["message"]= "Successfully Added";
        $this->return_json($message);
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

    public function get(){
        return $this->Product->get();
    }
}