<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class Data_source_model extends App_Model {

  public $table = 'data_sources';

  function __construct() {
    parent::__construct();
  }

  function get_all($conditions = array(), $count = FALSE, $limit = NULL, $offset = NULL) {
    $this->db->select('data_sources.*, sub_districts.name AS sub_district_name')
            ->join('sub_districts', 'sub_districts.id = data_sources.sub_district_id', 'left')
            ->from($this->table);
    if (!empty($conditions)) {
      if (isset($conditions['data_sources.id'])) {
        $this->db->where('data_sources.id', $conditions['data_sources.id']);
        unset($conditions['data_sources.id']);
      }
      $this->db->like($conditions);
    }

    if (!empty($limit) || !empty($offset)) {
      $this->db->limit($limit, $offset);
    }

    if ($count) {
      $data_sources = $this->db->count_all_results();
    } else {
      $data_sources = $this->db->get()->result();
    }
    return $data_sources;
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    if (empty($id)) {
      $data['is_default'] = 0;
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