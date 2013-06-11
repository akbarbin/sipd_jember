<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Instance extends Public_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Instance_model');
  }

  public function index() {
    $this->data['title'] = 'Data Instansi';
    $this->data['instances'] = $this->Instance_model->get_all();
    $this->load->view('layout/default', $this->data);
  }


}

?>