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
      $this->db->where($conditions);
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
      $insert = $this->setInsertData($data);
      return $this->db->insert($this->table, $insert);
    } else {
      $this->db->where($primary_key, $id);
      $update = $this->setUpdateData($data);
      return $this->db->update($this->table, $update);
    }
  }

  function remove($id = NULL, $field = 'id') {
    return $this->db->delete($this->table, array($field => $id));
  }

}

?>