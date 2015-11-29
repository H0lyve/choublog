<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_vignette extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('m_vignette');
    }
    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
    public function add(){
        $errors     = array();
        $maxsize    = 2097152;
        $acceptable = array(
                            'image/jpeg',
                            'image/jpg',
                            'image/gif',
                            'image/png'
                            );

        if(($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
            $errors[] = 'File too large. File must be less than 2 megabytes.';
        }

        if(!in_array($_FILES['image']['type'], $acceptable) && (!empty($_FILES["image"]["type"]))) {
            $errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
        }

        if(count($errors) === 0) {
            if ($_FILES["image"]["error"] == 0) {
                $tmp_name = $_FILES["image"]["tmp_name"];
                $name = $this->random_string(20).substr($_FILES["image"]['name'], -4);
                move_uploaded_file($tmp_name,'public/images/vignette/'.$name);
            }
            $this->m_vignette->add($name,$_POST['user_id'],$_POST['story_id']);
            header('Location: '.base_url('index.php/c_main/story/'.$_POST['story_id']));
        }else{
            header('Location: '.base_url('index.php/c_main/vignette_add/1?error=1'));
        }
    }

    public function moderation($id,$status){
        $this->m_vignette->moderate($id,$status);
        header('Location: '.base_url('index.php/c_main/moderation/'));
    }
    
}