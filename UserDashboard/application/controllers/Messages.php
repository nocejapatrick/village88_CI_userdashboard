<?php 
class Messages extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User");
        $this->load->model("Message");
        $this->load->model("Comment");
    }

    public function create_message(){
        $message = $this->input->post(null,true);
        $message["from_id"] = $this->session->userdata('user')->id;
        $myMessage = $this->Message->insert($message);

        if($myMessage===true){
            redirect(base_url().'users/show/'.$message["to_id"]);
        }else{
            $this->error_arrays($myMessage);
            redirect(base_url().'users/show/'.$message["to_id"]);
        }
    }

    public function comment_add(){
        $comment = $this->input->post(null,true);
        $comment["user_id"] = $this->session->userdata('user')->id;
        $myComment = $this->Comment->insert($comment);
       

        $message = $this->Message->find($this->input->post('message_id'));

        if($myComment === true){
            redirect(base_url().'users/show/'.$message->to_id);
        }else{
            foreach($myComment as $key=>$value){
                $this->session->set_flashdata($key.'_error_'.$this->input->post('message_id'),$value);
            }
            redirect(base_url().'users/show/'.$message->to_id);
        }
    }

}