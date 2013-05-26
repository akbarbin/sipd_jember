<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * App Controller use to add all function used by any user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class App_Controller extends CI_Controller {

  public static $sessionLogin;
  public $data = array();

  public function __construct() {
    parent::__construct();

    self::$sessionLogin = $this->session->all_userdata();
    $this->data['controller'] = $this->router->class;
    $this->data['action'] = $this->router->method;
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
        'redirect' => array(
            TRUE => 'Halaman yang anda akses benar.',
            FALSE => 'Terjadi kesalahan pada halaman yang anda akses.'
        )
    );

    $alert = array(
        TRUE => 'success',
        FALSE => 'error'
    );

    $message = (empty($message)) ? $actions[$action][$callback_action] : $message;

    $this->session->set_flashdata('message', array('alert' => $alert[$callback_action], 'message' => $message));
  }

  protected function get_login_status() {
    if (self::$sessionLogin[md5('login')] != md5(TRUE)) {
      return TRUE;
    }
    return FALSE;
  }

  protected function get_login_active_id() {
    return self::$sessionLogin[md5('id')];
  }

  protected function get_login_active_name() {
    return self::$sessionLogin[md5('name')];
  }
  
  protected function get_list($data = NULL){
    $list = array();
    foreach ($data as $value) {
      $list[$value->id] = $value->name;
    }
    return $list;
  }
  
  protected function set_data_before_update($data = array()){
    if(isset($data['id'])) unset($data['id']);
    return $data;
  }

  protected function get_password_salt(){
    $start = rand(0, 23);
    return substr(md5(rand(1,10000)), $start, 8);
  }
  
  protected function set_password($password = NULL, $password_salt = NULL){
    $password_salt = (empty($password_salt)) ? $this->get_password_salt() : $password_salt;
    return md5($password_salt.md5($password));
  }
  
  protected function get_validate_password($password = NULL ,$user = NULL){
    if($this->set_password($password, $user->password_salt) == $user->password){
      return TRUE;
    }
    return FALSE;
  }

  protected function set_encrype_user_data($data = array()){
    unset($data['confirmation_password']);
    $data['password_salt'] = $this->get_password_salt();
    $data['password'] = $this->set_password($data['password'], $data['password_salt']);
    return $data;
  }

}

?>