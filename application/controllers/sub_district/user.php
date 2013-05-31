<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class User extends Sub_District_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model', '', TRUE);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function load admin user edit account page.
   */
  public function edit_account() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $update = $this->User_model->update($this->set_data_before_update($this->input->post()), $this->get_login_active_id());
      $this->error_message('update', $update);
      redirect('sub_district/dashboard');
    } else {
      $user = $this->User_model->get_user_by_id($this->get_login_active_id());
      $this->data['user'] = $user[0];
      $this->data['title'] = 'Edit User Account ' . $user[0]->name;
      $this->load->view('layout/sub_district', $this->data);
    }
  }

  public function change_password() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $post = $this->input->post();
      $user = $this->User_model->get_user_by_conditions(array('id' => $this->get_login_active_id()));
      if ($this->get_validate_password($post['old_password'], $user[0])) {
        unset($post['old_password']);
        $user = $this->set_encrype_user_data($post);
        $update = $this->User_model->update($this->set_data_before_update($user), $this->get_login_active_id());
        $this->error_message('update', $update);
        redirect('sub_district/dashboard');
      } else {
        $this->error_message(NULL, FALSE, 'Password lama yang anda masukkan salah.');
        redirect('sub_district/user/change_password');
      }
    } else {
      $user = $this->User_model->get_user_by_id($this->get_login_active_id());
      $this->data['title'] = 'Ganti Password user ' . $user[0]->name;
      $this->load->view('layout/sub_district', $this->data);
    }
  }

}

?>