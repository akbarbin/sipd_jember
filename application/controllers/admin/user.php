<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class User extends Admin_Controller {

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function load admin user edit account page.
   */
  public function edit_account() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      print_r("Masuk");die;
    } else {
      $user = $this->db->get_where('users', array('username' => self::$sessionLogin['username']))->result();
      $data['user'] = $user[0];
      $data['title'] = 'Edit User Account';
      $this->load->view('layout/admin', $data);
    }
  }

}

?>