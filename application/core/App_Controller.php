<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * App Controller use to add all function used by any user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class App_Controller extends CI_Controller {

  public static $sessionLogin;

  public function __construct() {
    parent::__construct();

    self::$sessionLogin = $this->session->all_userdata();
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param string $action
   * @param boolean $callback_action
   * @param string $message
   */
  protected function error_message($action = NULL, $callback_action = FALSE, $message = NULL) {
    $actions = array(
        'insert' => array(
            TRUE => 'Anda berhasil melakukan penyimpanan data.',
            FALSE => 'Anda gagal melakukan penyimpanan data'),
        'update' => array(
            TRUE => 'Anda berhasil melakukan perubahan data.',
            FALSE => 'Anda gagal melakukan perubahan data.'),
        'delete' => array(
            TRUE => 'Anda berhasil menghapus data.',
            FALSE => 'Anda gagal menghapus data.'),
    );

    $alert = array(
        TRUE => 'success',
        FALSE => 'error'
    );
    
    $message = (empty($message)) ? $actions[$action][$callback_action] : $message;
    
    $this->session->set_flashdata('message', array('alert' => $alert[$callback_action], 'message' => $message));

  }

}

?>