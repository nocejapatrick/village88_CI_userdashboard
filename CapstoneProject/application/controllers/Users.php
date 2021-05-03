<?php 
class Users extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User");
    }

    public function index(){
        $this->load->view('index');
    }

    public function if_user_logged_in(){
        if($this->session->userdata('user')){
            if($this->session->userdata('user')->user_level == 9){
                redirect(base_url().'dashboard/admin');
            }else{
                redirect(base_url().'dashboard');
            }
        }
    }

 

    public function is_admin(){
        if($this->session->userdata('user')->user_level != 9){
            redirect(base_url().'dashboard');
        }
    }

    public function signin(){
        $this->if_user_logged_in();


        $this->load->view('templates/users/signin');
    }

    public function register(){
        $this->if_user_logged_in();

        $this->load->view('templates/users/registration');
    }
    // my registration proccess logic
    public function registration_process(){
        $registered_user = $this->input->post(null,true);

        $isInsertSuccess = $this->User->create($registered_user);

        if($isInsertSuccess === true){
            $this->session->set_flashdata('success','Successfully Registered. Kindly Sign in.');
        }else{
            $this->error_arrays($isInsertSuccess);
        }
        redirect(base_url().'register');
    }

    // This is my Sign in logic

    public function signin_proccess(){
        $loginUser = $this->input->post(null,true);

        $hasUser = $this->User->signin($loginUser);

        if(isset($hasUser->id)){
            
        

            
            $this->session->set_userdata('user',$hasUser);

            
            if($hasUser->is_admin == 1){
                redirect(base_url().'dashboard/orders');
            }else{
                redirect(base_url());
            }

        }else{

            $this->error_arrays($hasUser);
            redirect(base_url().'signin');

        }
    }



    public function logout(){
        $this->session->unset_userdata('user');
        redirect(base_url().'signin');
    }
}