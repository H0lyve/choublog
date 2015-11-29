<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class VerifyLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('m_user','',TRUE);
 }
 
 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
 
   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('v_header');
     $this->load->view('v_loggin');
   }
   else
   {
     //Go to private area
     redirect('?loggin=1', 'refresh');
   }
 
 }
 
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');
 
   //query the database
   $result = $this->m_user->login($username, $password);
 
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
         $cookie = array(
                   'name' => 'username',
                   'value' => $row->user_name,
                   'expire' => time()+86400*120
                   );
         $this->input->set_cookie($cookie);
         $cookie = array(
                   'name' => 'id',
                   'value' => $row->user_id,
                   'expire' => time()+86400*120
                   );
         $this->input->set_cookie($cookie);
         $cookie = array(
                   'name' => 'loggin',
                   'value' => true,
                   'expire' => time()+86400*120
                   );
         $this->input->set_cookie($cookie);
         if($row->user_is_admin == 1 ){
             $cookie = array(
                   'name' => 'is_admin',
                   'value' => true,
                   'expire' => time()+86400*120
                   );
             $this->input->set_cookie($cookie);             
         }
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Mauvais Nom ou Mots de passe');
     return false;
   }
 }
}
?>