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

  function generate() {
    $this->load->model('Sub_district_model');
    $sub_districs = $this->Sub_district_model->get_all();
    $this->load->model('Master_tabular_model');
    $master_tabulars = $this->Master_tabular_model->get_all();
    $data = array();
    $i = 0;
    foreach ($sub_districs as $key => $sub_distric) {
      foreach ($master_tabulars as $key => $master_tabular) {
        $data[$i]['name'] = $master_tabular->name;
        $data[$i]['parent_id'] = $master_tabular->parent_id;
        $data[$i]['ancestry'] = $master_tabular->ancestry;
        $data[$i]['ancestry_depth'] = $master_tabular->ancestry_depth;
        $data[$i]['unit_id'] = $master_tabular->unit_id;
        $data[$i]['sub_district_id'] = $sub_distric->id;
        $data[$i]['ref_code'] = $master_tabular->ref_code;
        $i++;
      }
    }
    return $this->db->insert_batch($this->table, $data);
  }

}

?>