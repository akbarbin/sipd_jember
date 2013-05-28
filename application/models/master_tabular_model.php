<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Master_tabular_model extends App_Model {

  public $table = 'master_tabulars';

  function __construct() {
    parent::__construct();
  }

  function get_ancestry_depth($coditions = array(), $count = FALSE) {
    $this->db->select('*')
            ->from($this->table)
            ->where($coditions)
            ->order_by('ref_code');
    if ($count) {
      $menus = $this->db->count_all_results();
    } else {
      $menus = $this->db->get()->result();
    }
    return $menus;
  }

  function get_all($conditions = array(), $count = FALSE, $limit = NULL, $offset = NULL) {
    $this->db->select('*')
            ->from($this->table);
    if (!empty($conditions)) {
      if (isset($conditions['id'])) {
        $this->db->where('id', $conditions['id']);
        unset($conditions['id']);
      }
      $this->db->where($conditions);
    }

    if (!empty($limit) || !empty($offset)) {
      $this->db->limit($limit, $offset);
    }

    if ($count) {
      $master_tabulars = $this->db->count_all_results();
    } else {
      $master_tabulars = $this->db->get()->result();
    }
    return $master_tabulars;
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    if (empty($id)) {
      $parent = $this->get_all(array('id' => $data['parent_id']));
      if (!empty($parent)) {
        $data['ancestry'] = (empty($parent[0]->ancestry)) ? $parent[0]->ancestry : $parent[0]->ancestry . '/' . $parent[0]->id;
        $data['ref_code'] = $parent[0]->ref_code.'.'.($this->get_ancestry_depth(array('parent_id' => $parent[0]->id), TRUE) + 1);
        $data['ancestry_depth'] = $parent[0]->ancestry_depth + 1;
      }else{
        $data['ref_code'] = $this->get_ancestry_depth(array('parent_id' => NULL), TRUE) + 1;
        $data['ancestry_depth'] = 0;
      }
      return $this->db->insert($this->table, $data);
    } else {
      $this->db->where($primary_key, $id);
      return $this->db->update($this->table, $data);
    }
  }

  function remove($id = NULL, $field = 'id') {
    return $this->db->delete($this->table, array($field => $id));
  }
  
}

?>