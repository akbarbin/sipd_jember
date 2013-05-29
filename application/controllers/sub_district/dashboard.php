<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Dashboard extends Sub_District_Controller {

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function load admin dashboard index page.
   */
  public function index() {
    $this->data['title'] = 'Dashboard';
    $this->data['content'] = 'admin/dashboard/index';
    $this->load->view('layout/sub_district', $this->data);
  }  
}