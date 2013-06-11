<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Tabular extends Public_Controller {

  private $uid;

  public function __construct() {
    parent::__construct();
    $this->load->model('Master_tabular_model');
    $this->load->model('Tabular_model');
    $this->uid = $this->uri->segment(3);
  }

  public function index() {
    if (empty($this->uid)) {
      $this->data['tabulars'] = $this->get_list($this->Master_tabular_model->get_all(array(
                  'type' => 'profil',
                  'ancestry_depth' => 1
      )));
    } else {
      $this->data['tabulars'] = $this->get_list($this->Master_tabular_model->get_all(array(
                  'type' => 'profil',
                  'ancestry_depth' => 1,
                  'parent_id' => $this->uid
      )));
    }
    $years = $this->Tabular_model->get_years();
    $this->data['years'][NULL] = '- PILIHAN -';
    foreach ($years as $year) {
      $this->data['years'][$year->year] = $year->year;
    }

    $this->data['title'] = 'Data Profil Kab. Jember';
    $this->data['id'] = $this->uid;
    $this->data['year'] = $this->data['tabular'] = array();
    $post = $this->input->post();
    $this->data['datas'] = array();
    if (!empty($post)) {
      $tabulars = $this->db->query('SELECT master_tabulars.id,
          master_tabulars.ref_code,
          master_tabulars.ancestry_depth,
          master_tabulars.name, 
          units.name AS unit_name
        FROM master_tabulars
          LEFT JOIN units ON units.id = master_tabulars.unit_id
        WHERE master_tabulars.type = "profil"
          AND master_tabulars.ref_code LIKE CONCAT(
            (SELECT ref_code 
            FROM master_tabulars 
            WHERE id = ' . $post['tabular_id'] . '),".%")')->result();

      $tabular_years = array();
      for ($i = ($post['year'] - 4); $i <= $post['year']; $i++) {
        $tabular_years[$i] = $this->db->query('SELECT master_tabular_id, 
          SUM(value) AS total
          FROM tabulars
          WHERE type="profil"
            AND year = "' . $i . '"
            AND ref_code LIKE CONCAT(
              (SELECT ref_code 
              FROM master_tabulars 
              WHERE id = ' . $post['tabular_id'] . '),".%")
          GROUP BY master_tabular_id')->result();
      }

      $this->data['isset_years'] = array();
      foreach ($tabular_years as $key => $value) {
        if (!empty($value)) {
          $this->data['isset_years'][] = $key;
        }
      }

      foreach ($tabulars as $key => $value) {
        $this->data['datas'][$key] = $value;
        foreach ($this->data['isset_years'] as $v) {
          $this->data['datas'][$key]->years[$v] = $tabular_years[$v][$key]->total;
        }
      }
    }
    $this->load->view('layout/default', $this->data);
  }

  public function view() {
    $tabulars = $this->db->query('SELECT master_tabulars.id,
          master_tabulars.ref_code,
          master_tabulars.ancestry_depth,
          master_tabulars.name, 
          units.name AS unit_name
        FROM master_tabulars
          LEFT JOIN units ON units.id = master_tabulars.unit_id
        WHERE master_tabulars.type = "profil"
          AND master_tabulars.ref_code LIKE CONCAT(
            (SELECT ref_code 
            FROM master_tabulars 
            WHERE id = ' . $this->uid . '),".%")')->result();

    $this->data['years'] = $years = $this->Tabular_model->get_years();

    foreach ($years as $year) {
      $tabular_years[$year->year] = $this->db->query('SELECT master_tabular_id, 
          SUM(value) AS total
          FROM tabulars
          WHERE type="profil"
            AND year = "' . $year->year . '"
            AND ref_code LIKE CONCAT(
              (SELECT ref_code 
              FROM master_tabulars 
              WHERE id = ' . $this->uid . '),".%")
          GROUP BY master_tabular_id')->result();
    }

    $this->data['datas'] = array();
    foreach ($tabulars as $key => $value) {
      $this->data['datas'][$key] = $value;
      foreach ($years as $v) {
        $this->data['datas'][$key]->years[$v->year] = $tabular_years[$v->year][$key]->total;
      }
    }
    $this->load->view('layout/default', $this->data);
  }

}

?>