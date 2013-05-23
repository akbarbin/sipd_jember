<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * User model use to add all behavior user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class User_model extends App_Model {

  var $table = 'users';

  function __construct() {
    parent::__construct();
  }

  function validate($username = NULL, $password = NULL) {
    $data = $this->db->get_where($this->table, array('username' => $username, 'password' => md5($password), 'is_remove' => 0));
    return $data->result();
  }

  function register($data = array()) {
    $data['is_remove'] = 0;
    $return = $this->db->insert($this->table, $data);
    return $return;
  }

}

?>