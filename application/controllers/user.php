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

      $user = $this->User_model->get_user_by_conditions(array('username' => $username, 'is_remove' => 0));
      if ($this->get_validate_password($password, $user[0])) {
        $this->session->set_userdata($this->__setSessionDataLogin($user[0]));
        $this->session->set_flashdata('message', array('alert' => 'success', 'message' => 'Anda berhasil login di SIPD Jember'));
        switch ($user[0]->role_id) {
          case 1 :
            redirect('admin/dashboard');
            break;
          case 2:
            redirect('sub_district/dashboard');
            break;
          default :
            $this->session->set_flashdata('message', array('alert' => 'error', 'message' => 'Maaf anda tidak memiliki hak akses.'));
            redirect('user/login');
            break;
        }
      } else {
        $this->session->set_flashdata('message', array('alert' => 'error', 'message' => 'Maaf, Username atau Password Anda salah'));
        $data['title'] = 'Login User SIPD Jember';
        $this->load->view('layout/blank', $data);
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
    $data = $this->set_data_session(array(
        'id' => $data->id,
        'name' => $data->name,
        'login' => md5(TRUE),
        'role_id' => md5($data->role_id),
        'sub_district_id' => $data->sub_district_id
    ));
    return $data;
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function used by user to logout
   */
  public function logout() {
    $this->session->sess_destroy();
    $this->session->set_flashdata('message', array('alert' => 'success', 'message' => 'Anda berhasil logout dari SIPD Jember.'));
    redirect('user/login');
  }

}

?>