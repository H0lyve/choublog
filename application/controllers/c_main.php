<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_main extends CI_Controller {
    
    public function __construct(){
            parent::__construct();
    }       

    public function index(){        
		$this->load->view('v_header');
        $this->load->view('v_home');
        $this->load->view('v_footer');
    }
    public function loggin(){
        $this->load->view('v_header');
        $this->load->view('v_loggin');
        $this->load->view('v_footer');
    }
    public function stories(){        
        $this->load->model('m_story');
        $data = $this->m_story->get_all_stories(true);
        $this->load->view('v_header');        
        $this->load->view('v_story_list',$data);
        $this->load->view('v_footer');
    }
    public function story($id){ 
        $this->load->model('m_story');
        $data['story'] = $this->m_story->story($id);
        $data['token'] = $this->m_story->check_token($id);
        $this->load->view('v_header');        
        $this->load->view('v_story',$data);
        $this->load->view('v_footer');
    }
    public function story_create(){
        if($this->input->cookie('loggin')){
            $this->load->view('v_header');
            $this->load->view('v_story_create');
            $this->load->view('v_footer');
        }else{
         //If no session, redirect to login page
         redirect('index.php/c_main/stories?logged=0', 'refresh');
       }
    }
    public function vignette_add($story_id){
        if($this->input->cookie('loggin')){
            $data = array('story_id' => $story_id);
            $this->load->view('v_header');
            $this->load->view('v_vignette_create',$data);
            $this->load->view('v_footer');
        }else{
         //If no session, redirect to login page
         redirect('index.php/c_main/stories?logged=0', 'refresh');
       }
    }
    public function moderation($page=''){
        if($page=='comments'){
            $this->load->model('m_comment');
            $data['comments'] = $this->m_comment->get_all();
        }elseif($page=='users'){
            $this->load->model('m_user');
            $data['users'] = $this->m_user->get_all();            
        }else{
            $this->load->model('m_vignette');
            $data['vignettes'] = $this->m_vignette->get_all();            
        }
        $this->load->view('v_header');
        $this->load->view('v_moderation',$data);
        $this->load->view('v_footer');
    }
    
}
