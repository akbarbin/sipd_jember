<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Tabular extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Tabular_model');
  }

  public function index() {
    $this->load->model('Sub_district_model');
    $post = $this->input->post();
    if (empty($post)) {
      $this->data['title'] = 'Data Tabular Kecamatan';
    } else {
      $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
              array(
                  'tabulars.sub_district_id' => $post['sub_district_id'],
                  'tabulars.year' => $post['year'],
                  'tabulars.ancestry_depth <' => 2));

      $sub_district = $this->Sub_district_model->get_all(array('id' => $post['sub_district_id']));

      $this->data['title'] = 'Data Tabular Kecamatan ' . $sub_district[0]->name . ' Tahun ' . $post['year'];
    }

    $this->data['sub_district_list'] = $this->get_list($this->Sub_district_model->get_all());

    $tabular_years = $this->Tabular_model->get_years();
    $this->data['tabular_years'] = array();
    foreach ($tabular_years as $key => $value) {
      $this->data['tabular_years'][$value->year] = $value->year;
    }
    if (empty($this->data['tabular_years'])) {
      $this->error_message(NULL, FALSE, 'Belum terdapat data pada tabular kecamatan.');
    }

    $this->load->view('layout/admin', $this->data);
  }

  public function view() {
    $tabular = $this->Tabular_model->get_all(array('id' => self::$id));
    $this->data['ancestry_depth'] = $tabular[0]->ancestry_depth;

    $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
            array(
                'tabulars.sub_district_id' => $tabular[0]->sub_district_id,
                'tabulars.year' => $tabular[0]->year,
                'tabulars.ref_code LIKE' => '%'.$tabular[0]->ref_code.'%'));

    $this->load->model('Sub_district_model');
    $sub_district = $this->Sub_district_model->get_all(array('id' => $tabular[0]->sub_district_id));

    $this->data['title'] = 'Data Tabular ' . $tabular[0]->name . ' Kecamatan ' . $sub_district[0]->name . ' Tahun ' . $tabular[0]->year;
    $this->load->view('layout/admin', $this->data);
  }

}

?>