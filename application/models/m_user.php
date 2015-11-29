<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    
    public function __construct(){
            parent::__construct();
    }
    
    public function get_user($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('users');
        
        return($query->result_array());
    }
    public function get_all(){
        $query = $this->db->get('users');
        return $query->result_array();
    }
    public function moderate($id,$status){
        $data = array( 'user_moderation_status' => $status);
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);        
    }
    function login($username, $password){
       $this -> db -> select('user_id, user_name, user_psw, user_is_admin');
       $this -> db -> from('users');
       $this -> db -> where('user_name', $username);
       $this -> db -> where('user_psw', MD5($password));
       $this -> db -> limit(1);

       $query = $this -> db -> get();

       if($query -> num_rows() == 1)
       {
         return $query->result();
       }
       else
       {
         return false;
       }
     }
    
    public function create_user($name,$mail,$psw){
        $data = array(
                    'user_name' => $name,
                    'user_mail_address'=> $mail,
                    'user_psw' => MD5($psw),
                    'user_created_at' => date('Y-m-d H:i:s')
                    );
        $this->db->insert('users', $data);        
        $result = array(
                        'is' => $this->db->insert_id(),
                        'status' => true
                        );
        return($result);
    }
    
}