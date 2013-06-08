<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Database_migration extends Admin_Controller {

  public function set_parent_id() {
    $master_tabulars = $this->db->select('*')
            ->from('master_tabulars')
            ->order_by('id', 'ASC')
            ->get();

    foreach ($master_tabulars->result() as $master_tabular) {
      $ancestry = explode('/', $master_tabular->ancestry);
      $parent_id = ($ancestry[(count($ancestry) - 1)] == 0) ? NULL : $ancestry[(count($ancestry) - 1)];
      $update = $this->db->where('id', $master_tabular->id)
              ->update('master_tabulars', array('parent_id' => $parent_id));
      if ($update) {
        echo 'Data Before : ' . json_encode($master_tabular) . ' => Data After : ' . json_encode($this->db->get_where('master_tabulars', array('id' => $master_tabular->id))->result());
        echo '<hr>';
      }
    }
  }

  public function set_ref_code() {
    $master_tabulars = $this->db->select('*')
            ->from('master_tabulars')
            ->order_by('id', 'ASC')
            ->get();

    $ref = array(0 => NULL, 1 => NULL, 2 => NULL, 3 => NULL);
    $dept_before = 0;
    foreach ($master_tabulars->result() as $key => $master_tabular) {

      if ($dept_before != $master_tabular->ancestry_depth) {
        foreach ($ref as $key_ref => $val_ref) {
          if ($master_tabular->ancestry_depth < $key) {
            $ref[$key_ref] = NULL;
          }
        }
      }


      $dept_before = $master_tabular->ancestry_depth;
      $ref[$master_tabular->ancestry_depth]++;

      $ref_code = array();
      foreach ($ref as $key => $value) {
        if (!empty($value)) {
          $ref_code[] = $value;
        }
      }

      $update = $this->db->where('id', $master_tabular->id)
              ->update('master_tabulars', array('ref_code' => implode('.', $ref_code)));
      if ($update) {
        echo 'Data Before : ' . json_encode($master_tabular) . ' => Data After : ' . json_encode($this->db->get_where('master_tabulars', array('id' => $master_tabular->id))->result());
        echo '<hr>';
      }
    }
  }

}