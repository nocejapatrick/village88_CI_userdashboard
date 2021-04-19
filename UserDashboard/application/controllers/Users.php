<?php 
class Users extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User");
        $this->load->model("Message");
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

    public function user_logged_in(){
        if($this->session->userdata('user') == null){
            redirect(base_url().'signin');
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

    public function new(){
        $this->user_logged_in();
        $this->is_admin();

        $this->load->view('templates/users/new');
    }

    public function delete(){
        $this->user_logged_in();
        $this->is_admin();
        $this->User->delete($this->input->post('user_id',true));

        $this->session->flashdata('success','User successfully Deleted');
        redirect(base_url().'dashboard/admin');
    }

    public function show($id){
        $this->user_logged_in();

        $user = $this->User->find($id);
        $user->messages = $this->Message->get_message_by_user_id($id);
        // var_dump($user);
        // die;
        $this->load->view('templates/users/show',array('user'=>$user));
    }

    public function edit($id=null){
        $this->user_logged_in();
        
        $user = ($id != null) ? $this->User->find($id) : $this->User->find($this->session->userdata('user')->id);



        if($user == null){
            $this->load->view('templates/users/not_found');
        }else{
            $this->load->view('templates/users/edit',array('user'=> $user));
        }
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

    // Creation of my user accounts

    public function new_user_process(){
        $registered_user = $this->input->post(null,true);

        $isInsertSuccess = $this->User->create($registered_user);

        if($isInsertSuccess === true){
            $this->session->set_flashdata('success','Successfully Registered. Kindly Sign in.');
        }else{
            $this->error_arrays($isInsertSuccess);
        }
        redirect(base_url().'users/new');
    }

    // This is my Sign in logic

    public function signin_proccess(){
        $loginUser = $this->input->post(null,true);

        $hasUser = $this->User->signin($loginUser);

        if(isset($hasUser->id)){
            
            $isUserAdmin = $this->User->is_user_admin($hasUser->id);
            
            $this->session->set_userdata('user',$hasUser);

            if($isUserAdmin){
                redirect(base_url().'dashboard/admin');
            }else{
                redirect(base_url().'dashboard');
            }

        }else{

            $this->error_arrays($hasUser);
            redirect(base_url().'signin');

        }
    }

    // my Process of user edit
    public function edit_information_process(){
        $editUser = $this->input->post(null,true);

        if($this->session->userdata('user')->user_level == 1){
            $editUser["id"] = $this->session->userdata('user')->id;
        }

        $editedUser = $this->User->update($editUser);

        if($editedUser === true){
            $this->session->set_flashdata('success','Successfully Updated');
            if($this->session->userdata('user')->user_level == 9){
                redirect(base_url().'users/edit/'.$editUser["id"]);
            }else{
                redirect(base_url().'users/edit/');
            }
         
        }else{
            $this->error_arrays($editedUser);
            if($this->session->userdata('user')->user_level == 9){
                redirect(base_url().'users/edit/'.$editUser["id"]);
            }else{
                redirect(base_url().'users/edit/');
            }
        }
    }

    // my change password proccess on user's profile
    public function change_password_process(){
        $changePassInputs = $this->input->post(null,true);

        if($this->session->userdata('user')->user_level == 1){
            $changePassInputs["id"] = $this->session->userdata('user')->id;
        }

        $changePass = $this->User->changePass($changePassInputs);

        if($changePass === true){
            $this->session->set_flashdata('success_updated_password','Successfully Updated');
            if($this->session->userdata('user')->user_level == 9){
                redirect(base_url().'users/edit/'.$changePass["id"]);
            }else{
                redirect(base_url().'users/edit/');
            }
        }else{
           
            $this->error_arrays($changePass);
            if($this->session->userdata('user')->user_level == 9){
                redirect(base_url().'users/edit/'.$changePass["id"]);
            }else{
                redirect(base_url().'users/edit/');
            }
        }
    }


    // my edit description procecss on user's profile
    public function edit_description_process(){
        $description = $this->input->post(null,true);
        $description["id"] = $this->session->userdata('user')->id;

        $editDescription = $this->User->edit_description($description);

     
        $this->session->set_flashdata('success_description','Successfully Updated');
    
        redirect(base_url().'users/edit/');

    }

    public function logout(){
        $this->session->unset_userdata('user');
        redirect(base_url().'signin');
    }
}