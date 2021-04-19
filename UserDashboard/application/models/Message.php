<?php
class Message extends MY_Model{

    
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "messages";
    }

    public function insert($arr){
        $this->form_validation->set_rules('message', 'Message', 'required');
       
       
        if ($this->form_validation->run() == FALSE)
        {
            return $this->form_validation->error_array();
        }
        else
        {
          
            $this->db->insert($this->table_name,$arr);
            return true;
        }
    }

    public function find($id){
        return $this->db->get_where($this->table_name,array("id"=>$id))->row();
    }


    // getting the user's message with their comments
    
    public function get_message_by_user_id($id){
       $messages = $this->db->get_where($this->table_name,array('to_id'=>$id))->result();
        
        foreach($messages as &$message){
            $message->from = $this->db->get_where('users',array('id'=>$message->from_id))->row();
            $comments = $this->db->get_where('comments',array('message_id'=>$message->id))->result();
            // var_dump($comments);
            // die;

            foreach($comments as &$comment){
                $comment->from = $this->db->get_where('users',array('id'=>$comment->user_id))->row();
            }
            $message->comments = $comments;
        }

        // var_dump($messages);
        // die;

       return $messages;

    }
}