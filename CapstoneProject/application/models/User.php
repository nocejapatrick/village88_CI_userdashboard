<?php
class User extends MY_Model{

    
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "users";
    }

    public function get(){
        return $this->db->get($this->table_name)->result();
    }

    public function find($id){
        return $this->db->get_where($this->table_name,array('id'=>$id))->row();
    }

    public function is_user_admin($id){
        return $this->db->get_where($this->table_name,array('id'=>$id))->row()->user_level == 9;
    }

    public function delete($id){
        $this->db->delete($this->table_name,array('id'=>$id));
    }

    public function create($arr){

        $this->form_validation->set_rules($this->registration_rules());

        if ($this->form_validation->run() == FALSE)
        {
              return $this->form_validation->error_array();
        }
        else
        {

            // generation of my salt
            $salt = $this->generate_rand(10);
            $password = md5($salt.$arr["password"]);
            $arr["password"] = $password;
            $arr["salt"] = $salt;
            if(count($this->get()) > 0){
                $arr["is_admin"] = 0;
            }else{
                $arr["is_admin"] = 1;
            }
      
        
            unset($arr["confirm_password"]);
            
            $this->db->insert($this->table_name,$arr);

            return true;
        }

    }


    public function find_user_by_email($str){
        return $this->db->get_where($this->table_name, array('email'=>$str))->row();
    }

    // Sign in database level logic

    public function signin($arr){
        $this->form_validation->set_rules($this->signin_rules());

        if ($this->form_validation->run() == FALSE)
        {
              return $this->form_validation->error_array();
        }
        else
        {
            $user = $this->find_user_by_email($arr["email"]);

            if($user){
                $password=md5($user->salt.$arr["password"]);

                if($user->password == $password){

                    return $user;

                }else{

                    return array("password"=>"Check Password");  

                }

            }else{

                return array("email"=>"Email do not exist");

            }
        }
    }

    // my sign in rules

    public function signin_rules(){
        return array(
            array(
                "field"=>"email",
                "label"=>"Email",
                "rules"=>"required|valid_email"
            ),
            array(
                "field"=>"password",
                "label"=>"Password",
                "rules"=>"required"
            )
        );
    }

   

    public function registration_rules(){
        return array(
            array(
                "field"=>"email",
                "label"=>"Email",
                "rules"=>"required|valid_email|is_unique[users.email]"
            ),
            array(
                "field"=>"first_name",
                "label"=>"First Name",
                "rules"=>"required"
            ),
            array(
                "field"=>"last_name",
                "label"=>"Last Name",
                "rules"=>"required"
            ),
            array(
                "field"=>"password",
                "label"=>"Password",
                "rules"=>"required|min_length[6]"
            ),
            array(
                "field"=>"confirm_password",
                "label"=>"Confirm_password",
                "rules"=>"required|min_length[6]|matches[password]"
            ),
        );
    }
    
}