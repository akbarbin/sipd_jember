<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index() {
    $data['content'] = 'dashboard/index';
    $this->load->view('layout/admin', $data);
  }

}