<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_story extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_all_stories($validate = false){
        if($validate){
            $query = $this->db->query('SELECT s.story_id, s.story_title, s.story_description, s.story_created_at, u.user_name, v.vignette_img
                                    FROM stories s 
                                    INNER JOIN users u ON s.user_id = u.user_id 
                                    INNER JOIN vignettes v ON s.story_id = v.story_id 
                                    WHERE v.vignette_is_first = 1
                                    AND s.story_moderation_status != "-1"');
            $result['stories'] = $query->result_array();
        }else{
            $query = $this->db->query('SELECT s.story_id, s.story_title, s.story_description, s.story_created_at, u.user_name, v.vignette_img
                                        FROM stories s 
                                        INNER JOIN users u ON s.user_id = u.user_id 
                                        INNER JOIN vignettes v ON s.story_id = v.story_id 
                                        WHERE v.vignette_is_first = 1');
            $result['stories'] = $query->result_array();
        }
        $query = $this->db->query('SELECT c.comment_content, c.comment_posted_at, c.story_id, u.user_name
                                    FROM comments c
                                    INNER JOIN users u ON c.user_id = u.user_id
                                    WHERE c.vignette_id IS NULL 
                                    AND c.comment_moderation_status = 1
                                    ORDER BY c.comment_posted_at DESC');
        $result['comments'] = $query->result_array();
        
        return($result);
    }
    
    public function story($id){
        $query = $this->db->query('SELECT s.story_id, s.story_title, s.story_description, s.story_created_at, s.story_moderation_status, u.user_name
                                    FROM stories s 
                                    INNER JOIN users u ON s.user_id = u.user_id
                                    WHERE s.story_moderation_status != -1
                                    AND s.story_id='.$id);
        $result['data'] = $query->row_array();
        
        $query = $this->db->query('SELECT c.comment_content, c.comment_posted_at, c.story_id, c.vignette_id, u.user_name
                                    FROM comments c
                                    INNER JOIN users u ON c.user_id = u.user_id
                                    WHERE c.story_id='.$id.' 
                                    AND c.comment_moderation_status = 1
                                    ORDER BY c.comment_posted_at DESC');
        $result['comments'] = $query->result_array();
        
        $query =$this->db->query('SELECT v.vignette_id, v.vignette_img, v.vignette_posted_at, u.user_name
                                    FROM vignettes v
                                    INNER JOIN users u ON v.user_id = u.user_id
                                    WHERE story_id='.$id.'
                                    AND v.vignette_moderation_status = 1
                                    ORDER BY v.vignette_posted_at');
        $result['vignettes'] = $query->result_array();
        
        return($result);
    }
    
    public function create($title,$description,$image,$user){
        $data = array(
                    'story_title' => $title,
                    'story_description' => $description,
                    'user_id' => $user,
                    'story_moderation_status' => 0,
                    'story_updated_at' => date("Y-m-j H:i:s"),
                    'story_created_at' => date("Y-m-j H:i:s")
                    );
        
        $this->db->insert('stories', $data);
        $insert_id = $this->db->insert_id();
        $data = array(
                    'vignette_img' => $image,
                    'vignette_is_first' => 1,
                    'vignette_posted_at' => date("Y-m-j H:i:s"),
                    'user_id' => $user,
                    'story_id' => $insert_id
                    );
        $this->db->insert('vignettes', $data);
        return($insert_id);
        
    }
    
    public function take_token($id,$user){
        $startDate = time();
        $data = array(
                    'token_start' => date("Y-m-j H:i:s"),
                    'token_end' =>  date('Y-m-d H:i:s', strtotime('+1 day', $startDate)),
                    'story_id' => $id,
                    'user_id' => $user
                    );
        $this->db->insert('tokens',$data);
    }
    
    public function check_token($id){
        $query = $this->db->query('SELECT * 
                                FROM tokens
                                WHERE story_id = '.$id.'
                                AND token_end > "'.date("Y-m-j H:i:s").'" ');

        $result['active_token'] = $query->row_array();
        $query = $this->db->query('SELECT * 
                                FROM tokens
                                WHERE story_id = '.$id.'
                                ORDER BY token_end DESC
                                LIMIT 1 ');

        $result['last_token'] = $query->row_array();
        return $result;
       
    }
    
}