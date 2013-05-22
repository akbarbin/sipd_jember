<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends CI_Controller {

  function __construct() {
    parent::__construct();
//    $this->load->model('Member_model', '', TRUE);
  }

  public function login() {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == TRUE) {
      $username = $this->input->post('username');
      $password = $this->input->post('password');

//      $member = $this->Member_model->validate($username, $password);
      if (!empty($member)) {
        $data = $this->__setSessionDataLogin($member[0]);
        $this->session->set_userdata($data);
        redirect('page/home');
      } else {
        $this->session->set_flashdata('message', 'Maaf, Email atau Password Anda salah');
        redirect('member/login');
      }
    } else {
      $data['title'] = 'Login Pelanggan';
      $data['content'] = $this->router->class . '/' . $this->router->method;
      $this->load->view('layout/login', $data);
    }
  }
}
?>