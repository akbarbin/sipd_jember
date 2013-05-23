<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends Admin_Controller {
    
  public function edit_account(){
    $user = $this->db->get_where('users', array('username' => self::$sessionLogin['username']))->result();
    $data['user'] = $user[0];
    $data['title'] = 'Edit User Account';
    $data['content'] = 'user/edit_account';
    $this->load->view('layout/admin', $data);
  }

}
?>