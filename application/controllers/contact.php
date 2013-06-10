<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Contact extends Public_Controller {

  public function index() {
    $this->load->view('layout/default', $this->data);
  }

}

?>