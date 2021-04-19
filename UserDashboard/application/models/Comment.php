<?php
class Comment extends MY_Model{

    
    public function __construct()
    {
        parent::__construct();
        $this->table_name = "comments";
    }

    public function insert($arr){
        $this->form_validation->set_rules('comment', 'Comment', 'required');

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
}