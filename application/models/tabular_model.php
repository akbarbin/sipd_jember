<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Tabular_model extends App_Model {

  public $table = 'tabulars';

  function __construct() {
    parent::__construct();
  }

  function generate($year = NULL, $conditions = array()) {
    $year = (empty($year)) ? date('Y') : $year;
    $active_sub_districs = $this->get_sub_district($year);
    $sub_district_on_tabular = array();
    foreach ($active_sub_districs as $active_sub_distric) {
      $sub_district_on_tabular[] = $active_sub_distric->sub_district_id;
    }

    $this->load->model('Sub_district_model');
    $sub_districs = $this->Sub_district_model->get_all_where_not_in($sub_district_on_tabular);

    $this->load->model('Master_tabular_model');
    $master_tabulars = $this->Master_tabular_model->get_all($conditions);
    $data = array();
    foreach ($sub_districs as $key => $sub_distric) {
      $i = 0;
      foreach ($master_tabulars as $key => $master_tabular) {
        $data[$i] = $this->setInsertData(array(
            'name' => $master_tabular->name,
            'year' => $year,
            'parent_id' => $master_tabular->parent_id,
            'ancestry' => $master_tabular->ancestry,
            'ancestry_depth' => $master_tabular->ancestry_depth,
            'type' => $master_tabular->type,
            'unit_id' => $master_tabular->unit_id,
            'sub_district_id' => $sub_distric->id,
            'ref_code' => $master_tabular->ref_code,
            'master_tabular_id' => $master_tabular->id,
        ));
        if (isset($conditions['type'])) {
          $data[$i]['type'] = $conditions['type'];
        }
        $i++;
      }
      $this->db->insert_batch($this->table, $data);
      $data = array();
    }
    return TRUE;
  }

  function get_sub_district($year = NULL, $count = FALSE) {
    $this->db->select('sub_district_id')
            ->from($this->table)
            ->where('year', $year)
            ->group_by('sub_district_id');
    if ($count) {
      $tabulars = $this->db->count_all_results();
    } else {
      $tabulars = $this->db->get()->result();
    }
    return $tabulars;
  }

  function get_years($conditions = array()) {
    $this->db->select('year')
            ->from($this->table)
            ->group_by('year');
    if (!empty($conditions)) {
      $this->db->where($conditions);
    }
    return $this->db->get()->result();
  }

  function get_ancestry_depth($coditions = array(), $count = FALSE) {
    $this->db->select('tabulars.*, data_sources.name AS data_source_name, units.name AS unit_name')
            ->from($this->table)
            ->join('data_sources', 'data_sources.id = tabulars.data_source_id', 'left')
            ->join('units', 'units.id = tabulars.unit_id', 'left')
            ->where($coditions)
            ->order_by('tabulars.master_tabular_id');
    if ($count) {
      $tabulars = $this->db->count_all_results();
    } else {
      $tabulars = $this->db->get()->result();
    }
    return $tabulars;
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

  function save_all($data = array()) {
    $update = array();
    foreach ($data['data'] as $key => $value) {
      if (($value['value']['before'] != $value['value']['after']) || ($value['data_source_id']['before'] != $value['data_source_id']['after'])) {
        $update[] = $this->setUpdateData(
                array(
                    'id' => $key,
                    'value' => $value['value']['after'],
                    'data_source_id' => $value['data_source_id']['after']));
      }
    }
    if (!empty($update)) {
      return $this->db->update_batch($this->table, $update, 'id');
    } else {
      return TRUE;
    }
    return FALSE;
  }

  function get_max_year($conditions = array()) {
    $this->db->select_max('year')
            ->from($this->table)
            ->where($conditions);
    return $this->db->get()->result();
  }

  function save_all_import($data = array(), $primary_key = 'id') {
    $before_save = array();
    foreach ($data as $value) {
      $before_save[] = $this->setUpdateData($value);
    }
    return $this->db->update_batch($this->table, $before_save, $primary_key);
  }

  function save($data = array(), $id = NULL, $primary_key = 'id') {
    if (empty($id)) {
      $insert = $this->setInsertData($data);
      return $this->db->insert($this->table, $insert);
    } else {
      $this->db->where($primary_key, $id);
      $update = $this->setUpdateData($data);
      return $this->db->update($this->table, $update);
    }
  }

}

?>