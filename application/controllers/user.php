<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class User extends Public_Controller {
  
  function __construct() {
    parent::__construct();
    $this->load->model('User_model', '', TRUE);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function used by user to login and access admin page.
   */
  public function login() {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      $user = $this->User_model->validate($username, $password);
      if (!empty($user)) {
        $data = $this->__setSessionDataLogin($user[0]);
        $this->session->set_userdata($data);
        $this->session->set_flashdata('message', array('alert' => 'success', 'message' => 'Welcome SIPD Jember'));
        redirect('admin/dashboard');
      } else {
        $this->session->set_flashdata('message', array('alert' => 'error', 'message' => 'Maaf, Username atau Password Anda salah'));
        redirect('login');
      }
    } else {
      $data['title'] = 'Login User SIPD Jember';
      $this->load->view('layout/blank', $data);
    }
  }
  
  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param array $data Object User 
   * @return array $data Array User
   * 
   * Description :
   * This function use to convert object user to array user
   */
  private function __setSessionDataLogin($data = array()) {
    $data = array(
        'id' => $data->id,
        'name' => $data->name,
        'email' => $data->email,
        'username' => $data->username,
        'photo' => $data->photo,
        'sub_district_id' => $data->sub_district_id,
        'login' => TRUE
    );
    return $data;
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function used by user to logout
   */
  public function logout() {
    $this->session->set_flashdata('message', 'Maaf, Username atau Password Anda salah');
    $this->session->sess_destroy();
    redirect('user/login');
  }
  
}
?>