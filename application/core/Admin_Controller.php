<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Admin Controller use to add all function admin used by user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Admin_Controller extends App_Controller {

  public function __construct() {
    parent::__construct();

    /**
     * @author Mahendri Winata <mahen.0112@gmail.com>
     * 
     * Description :
     * Check User login status
     */
    if (!$this->get_login_status() || !$this->__get_login_role_status()) {
      $this->session->sess_destroy();
      $this->session->set_flashdata('message', array('alert' => 'error', 'message' => 'Anda tidak dapat mengakses halaman admin SIPD Jember.'));
      redirect('user/login');
    }

    $this->data['user_full_name'] = $this->get_login_active_name();
    $this->data['sidebar_menus'] = $this->__get_sidebar_menu();
  }

  private function __get_sidebar_menu() {
    $this->load->model('Master_tabular_model');
    return $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ancestry_depth <' => 2,
                'master_tabulars.type' => 'profil'));
  }

  private function __get_login_role_status() {
    if (self::$sessionLogin[md5('role_id')] == md5(1)) {
      return TRUE;
    }
    return FALSE;
  }

}

?>