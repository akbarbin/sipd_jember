<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Role_model extends App_Model {

  public $table = 'roles';

  function __construct() {
    parent::__construct();
  }

  function get_role_by_user_id($user_id = NULL) {
    $this->db->select('roles.*')
            ->from($this->table)
            ->join('users', 'users.role_id = roles.id')
            ->where('users.id', $user_id);
    $role = $this->db->get();
    return $role->result();
  }

}

?>