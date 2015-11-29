<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_vignette extends CI_Model {
    public function __construct(){
            parent::__construct();
    }
    
    public function add($name,$user,$story){
        $data = array(
                    'vignette_img' => $name,
                    'vignette_is_first' => 0,
                    'vignette_posted_at' => date("Y-m-j H:i:s"),
                    'user_id' => $user,
                    'story_id' => $story
                    );
        $this->db->insert('vignettes',$data);
        $query = $this->db->query('SELECT * 
                                FROM tokens
                                WHERE story_id = '.$story.'
                                ORDER BY token_start DESC
                                LIMIT 1 ');
        $last_token = $query->row_array();
        $data = array(
                    'token_end' => date("Y-m-j H:i:s")
                    );
        $this->db->where('token_id', $last_token['token_id']);
        $this->db->update('tokens', $data); 
        
    }
    public function get_all(){
        $query = $this->db->query('SELECT V.vignette_id,V.vignette_img,V.vignette_moderation_status,V.vignette_posted_at,v.user_id,v.story_id, v.vignette_is_first, u.user_name 
                                    FROM vignettes v 
                                    INNER JOIN users u ON v.user_id = u.user_id');
        $result = $query->result_array();        
        return($result);
    }
    public function get_all_valid(){
        $query = $this->db->query('SELECT V.vignette_id,V.vignette_img,V.vignette_moderation_status,V.vignette_posted_at,v.user_id,v.story_id, u.user_name 
                                    FROM vignettes v 
                                    INNER JOIN users u ON v.user_id = u.user_id
                                    WHERE V.vignette_moderation_status = 1');
        $result = $query->result_array();        
        return($result);
    }
    public function moderate($id,$status){
        $vignette = $this->db->get_where('vignettes',array('vignette_id'=>$id));
        $vignette = $vignette->row_array();
        if($vignette['vignette_is_first'] == 1 && $status == -1){
            $data = array(
                    'story_moderation_status' => -1
                    );
            $this->db->where('story_id', $vignette['story_id']);
            $this->db->update('stories', $data);            
        }elseif($vignette['vignette_is_first'] == 1 && $status == 1){
            $data = array(
                    'story_moderation_status' => 1
                    );
            $this->db->where('story_id', $vignette['story_id']);
            $this->db->update('stories', $data);   
        }
        
        $data = array('vignette_moderation_status' => $status);
        $this->db->where('vignette_id', $id);
        $this->db->update('vignettes', $data);        
    }
        
}