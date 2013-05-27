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

  function get_all($conditions = array(), $count = FALSE, $limit = NULL, $offset = NULL) {
    $this->db->select('*')
            ->from($this->table);
    if (!empty($conditions)) {
      if (isset($conditions['id'])) {
        $this->db->where('id', $conditions['id']);
        unset($conditions['id']);
      }
      $this->db->like($conditions);
    }

    if (!empty($limit) || !empty($offset)) {
      $this->db->limit($limit, $offset);
    }

    if ($count) {
      $roles = $this->db->count_all_results();
    } else {
      $roles = $this->db->get()->result();
    }
    return $roles;
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    /**
     * @todo chsnge role level when use multi level user
     */
    $data['level'] = 2;
    if (empty($id)) {
      return $this->db->insert($this->table, $data);
    } else {
      $this->db->where($primary_key, $id);
      return $this->db->update($this->table, $data);
    }
  }
  
  function remove($id = NULL, $field = 'id'){
    return $this->db->delete($this->table, array($field => $id));
  }
  
}

?>