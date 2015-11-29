<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_story extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('m_story');
    }
    
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    public function create(){
        if(!empty($_POST) && !empty($_FILES)){
            if ($_FILES["image"]["error"] == 0) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $name = $this->random_string(20).substr($_FILES["image"]['name'], -4);
                move_uploaded_file($tmp_name,'public/images/vignette/'.$name);
            }
            $id = $this->m_story->create(htmlentities($_POST['title']),htmlentities($_POST['description']),htmlentities($name),$_POST['user_id']);
            header('Location: '.base_url('index.php/c_main/story/'.$id));
        }        
    }
    public function take_token($id,$user){
        $tokens = $this->m_story->check_token($id);
        if(empty($tokens['active_token'])){
            $this->m_story->take_token($id,$user);
            header('Location: '.base_url('index.php/c_main/stories?token_taken=1'));
        }else{
            header('Location: '.base_url('index.php/c_main/stories?token_taken=0'));
        }
    }
    public function check_token($id){
        return($this->m_story->check_token($id));
    }
    
}