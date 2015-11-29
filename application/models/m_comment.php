<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_comment extends CI_Model {
    public function __construct(){
            parent::__construct();
    }
    
    public function add($content,$user_id,$story_id,$vignette_id = NULL){
        $data = array(
                    'comment_content' => $content,
                    'story_id' => $story_id,
                    'user_id' => $user_id,
                    'vignette_id' => $vignette_id,
                    'comment_posted_at' => date("Y-m-j H:i:s")
                    );
        $this->db->insert('comments',$data);        
    }
    public function get_all(){
        $query = $this->db->query('SELECT c.comment_id, c.comment_content, c.comment_moderation_status, c.comment_posted_at, c.story_id, c.vignette_id, c.user_id, u.user_name 
                                    FROM comments c 
                                    INNER JOIN users u ON c.user_id = u.user_id');
        $result = $query->result_array();        
        return($result);
    }
    public function get_all_valid(){
        $query = $this->db->query('SELECT c.comment_id, c.comment_content, c.comment_moderation_status, c.comment_posted_at, c.story_id, c.vignette_id, c.user_id, u.user_name 
                                    FROM comments c 
                                    INNER JOIN users u ON c.user_id = u.user_id
                                    WHERE c.comment_moderation_status = 1');
        $result = $query->result_array();        
        return($result);
    }
    public function moderate($id,$status){
        $data = array( 'comment_moderation_status' => $status);
        $this->db->where('comment_id', $id);
        $this->db->update('comments', $data);        
    }
    
}