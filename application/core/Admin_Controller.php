<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Admin Controller use to add all function admin used by user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Admin_Controller extends App_Controller {

  public static $segment_pagination = 4;
  public static $limit = 10;
  protected static $id;
  protected static $update_id;

  public function __construct() {
    parent::__construct();

    /**
     * @author Mahendri Winata <mahen.0112@gmail.com>
     * 
     * Description :
     * Check User login status
     */
    if (!$this->get_login_status()) {
      redirect('user/login');
    }

    $this->data['user_full_name'] = $this->get_login_active_name();
    $this->data['sidebar_menus'] = $this->__get_sidebar_menu();
    self::$id = $this->uri->segment(4);
    self::$update_id = $this->get_update_id();
  }

  protected function set_before_pagination($count = NULL, $suffix = NULL, $limit = NULL, $segment_pagination = NULL, $site_url = NULL) {
    $config['base_url'] = site_url((empty($site_url) ? $this->get_site_url_pagination() : $site_url));
    $config['total_rows'] = $count;
    $config['per_page'] = (empty($limit)) ? self::$limit : $limit;
    $config['uri_segment'] = (empty($segment_pagination)) ? self::$segment_pagination : $segment_pagination;
    $config['suffix'] = $suffix;
    return $config;
  }

  protected function set_after_pagination() {
    return $this->pagination->create_links();
  }

  protected function get_site_url_pagination($site_url = NULL) {
    return $this->router->directory . '/' . $this->router->class . '/' . $this->router->method;
  }

  protected function get_offset_from_segment($segment_pagination = NULL) {
    $segment_pagination = (empty($segment_pagination)) ? self::$segment_pagination : $segment_pagination;
    return $this->uri->segment($segment_pagination);
  }

  private function __get_sidebar_menu() {
    $this->load->model('Master_tabular_model');
    return $this->Master_tabular_model->get_ancestry_depth(array('ancestry_depth <' => 2));
  }
  protected function get_search_params($field = array()) {
    $params = array();
    if (isset($_GET) && !empty($_GET)) {
      foreach ($field as $key => $value) {
        $params[$value] = $_GET['search'];
      }
    }
    return $params;
  }
  
  protected function get_suffix_params(){
    $suffix = '';
    $params = $this->get_search_params();
    if (isset($_GET) && !empty($_GET)) {
      $str = array();
      foreach ($_GET as $key => $value) {
        $str[] = $key.'='.$value;
      }
      $suffix = '?'.  implode('&', $str);
    }
    return $suffix;
  }
  
  protected function get_encrype_site_url($url = NULL){
    $url = (empty($url)) ? $this->get_site_url_pagination() : $url;
    return md5($url);
  }

  protected function set_update_id($id = NULL, $url = NULL){
    $data = array('update' => array($this->get_encrype_site_url($url) => $id));
    $this->session->set_userdata($data);
  }
  
  protected function get_update_id(){
    $data= $this->session->userdata('update');
    $this->session->unset_userdata('update');
    return (isset($data[$this->get_encrype_site_url()])) ? $data[$this->get_encrype_site_url()] : NULL;
  }
  
}

?>