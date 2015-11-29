<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {
    
    public function __construct(){
            parent::__construct();
    }
    public function register(){
        if(!empty($_POST)){
            $this->load->model('m_user');
            $result = $this->m_user->create_user($_POST['name'],$_POST['mail'],$_POST['psw']);
            if($result['status']){
                $cookie = array(
                           'name' => 'username',
                           'value' => htmlentities($_POST['name']),
                           'expire' => time()+86400*120
                           );
                 $this->input->set_cookie($cookie);
                 $cookie = array(
                           'name' => 'id',
                           'value' => $result['id'],
                           'expire' => time()+86400*120
                           );
                 $this->input->set_cookie($cookie);
                 $cookie = array(
                           'name' => 'loggin',
                           'value' => true,
                           'expire' => time()+86400*120
                           );
                 $this->input->set_cookie($cookie);
                 header('Location: '.base_url().'?registered');
            }else{
                echo 'Une erreure c\'est produite';
            }
        }       
    }
    function logout(){
        delete_cookie('username');
        delete_cookie('loggin');
        delete_cookie('id');
        if($this->input->cookie('is_admin'))
            delete_cookie('is_admin');
        header('Location: '.base_url());
    }
    public function moderation($id,$status){
        $this->load->model('m_user');
        $this->m_user->moderate($id,$status);
        header('Location: '.base_url('index.php/c_main/moderation/users'));
    } 

}