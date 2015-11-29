<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_comment extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    public function add(){
        $this->load->model('m_comment');
        if(!empty($_POST)){
            if(empty($_POST['vignette_id'])){
                $this->m_comment->add(htmlentities($_POST['content']),$_POST['user_id'],$_POST['story_id']);
                header('Location: '.base_url('index.php/c_main/stories'));
            }else{
                $this->m_comment->add(htmlentities($_POST['content']),$_POST['user_id'],$_POST['story_id'],$_POST['vignette_id']);
                header('Location: '.base_url('index.php/c_main/story/'.$_POST['story_id']));
            }
        }
    }
    public function moderation($id,$status){
        $this->load->model('m_comment');
        $this->m_comment->moderate($id,$status);
        header('Location: '.base_url('index.php/c_main/moderation/comments'));
    } 
    
}