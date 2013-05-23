<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    $this->load->model('User_model', '', TRUE);
  }

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
        redirect('dashboard/');
      } else {
        $this->session->set_flashdata('message', 'Maaf, Username atau Password Anda salah');
        redirect('login');
      }
    } else {
      $data['title'] = 'Login User SIPD Jember';
      $this->load->view('layout/login', $data);
    }
  }
  
  function __setSessionDataLogin($data = array()) {
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

  public function logout() {
    $this->session->sess_destroy();
    redirect('user/login');
  }
  
  public function edit_account(){
    $user = $this->db->get_where('users', array('username' => self::$sessionLogin['username']))->result();
    $data['user'] = $user[0];
    $data['title'] = 'Edit User Account';
    $this->load->view('layout/admin', $data);
  }

}
?>