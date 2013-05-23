<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Dashboard use to add all function dashboard page
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Dashboard extends MY_Admin {

  public function index() {
    $data = array();
    $this->load->view('layout/admin', $data);
  }

}