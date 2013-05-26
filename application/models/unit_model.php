<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Unit_model extends App_Model {

  public $table = 'units';

  function __construct() {
    parent::__construct();
  }

  function get_all($conditions = array(), $count = FALSE, $limit = NULL, $offset = NULL) {
    $this->db->select('*')
            ->from($this->table);
    if (!empty($conditions)) {
      $this->db->like($conditions);
    }

    if (!empty($limit) || !empty($offset)) {
      $this->db->limit($limit, $offset);
    }

    if ($count) {
      $units = $this->db->count_all_results();
    } else {
      $units = $this->db->get()->result();
    }
    return $units;
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    if (empty($id)) {
      return $this->db->insert($this->table, $data);
    } else {
      $this->db->where($primary_key, $id);
      return $this->db->update($this->table, $data);
    }
  }
  
  function remove($id = NULL){
    return $this->db->delete($this->table, $id);
  }

}

?>