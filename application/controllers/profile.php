<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Profile extends Public_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Profile_model');
  }

  public function index() {
    $this->load->model('Image_model');
    $this->data['images'] = $this->Image_model->get_all();
    $profiles = $this->Profile_model->get_all();
    $this->data['profile'] = array();
    foreach ($profiles as $value) {
      $content = substr(preg_replace("/&#?[a-z0-9]+;/i", "", strip_tags($value->content)), 0, 400);

      $this->data['profile'][$value->slug] = array(
          'id' => $value->id,
          'slug' => $value->slug,
          'title' => $value->title,
          'content' => $content.'...'
      );
    }
    $this->load->view('layout/default', $this->data);
  }

}

?>