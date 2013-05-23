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
  public function edit_account(){
    $user = $this->db->get_where('users', array('username' => self::$sessionLogin['username']))->result();
    $data['user'] = $user[0];
    $data['title'] = 'Edit User Account';
    $data['content'] = 'user/edit_account';
    $this->load->view('layout/admin', $data);
  }

}
?>