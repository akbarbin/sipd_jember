<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Dashboard extends Admin_Controller {

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function load admin dashboard index page.
   */
  public function index() {
    $this->load->view('layout/admin', $this->data);
  }  
}