<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Tabular_performance extends Sub_District_Controller {

  private $uid;
  private $type = array(
      'kesejahteraan-masyarakat' => 'Aspek Kesejahteraan Masyarakat',
      'pelayanan-umum' => 'Aspek Pelayanan Umum',
      'daya-saing' => 'Aspek Daya Saing'
  );

  public function __construct() {
    parent::__construct();
    $this->load->model('Tabular_model');
    $this->uid = $this->uri->segment(5);

    if (!isset($this->type[self::$id])) {
      $this->error_message('redirect', FALSE);
      redirect('admin/dashboard');
    }
  }

  public function index() {
    $post = $this->input->post();
    if ($this->form_validation->run('search_tabular')) {
      $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
              array(
                  'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                  'tabulars.year' => $post['year'],
                  'tabulars.ancestry_depth <' => 2,
                  'tabulars.type' => 'kinerja-' . self::$id));

      $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id] . ' Tahun ' . $post['year'];
    } else {
      $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id] . ' Kecamatan';
    }

    $this->data['type'] = self::$id;
    $tabular_years = $this->Tabular_model->get_years(array('type' => 'kinerja-' . self::$id, 'sub_district_id' => $this->get_login_active_sub_district_id()));
    $this->data['tabular_years'] = array();
    foreach ($tabular_years as $key => $value) {
      $this->data['tabular_years'][$value->year] = $value->year;
    }
    if (empty($this->data['tabular_years'])) {
      $this->error_message(NULL, FALSE, 'Belum terdapat data pada tabular kecamatan.');
    }

    $this->load->view('layout/sub_district', $this->data);
  }

  public function view() {
    $tabular = $this->Tabular_model->get_all(array('id' => $this->uid));
    $this->data['ancestry_depth'] = $tabular[0]->ancestry_depth;
    $this->data['id'] = $this->uid;
    $this->data['type'] = self::$id;

    $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
            array(
                'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                'tabulars.year' => $tabular[0]->year,
                'tabulars.ref_code LIKE' => '%' . $tabular[0]->ref_code . '.%',
                'tabulars.type' => 'kinerja-' . self::$id));

    $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id] . ' ' . $tabular[0]->name . ' Tahun ' . $tabular[0]->year;
    $this->load->view('layout/sub_district', $this->data);
  }

  public function edit() {
    $post = $this->input->post();
    if (empty($post)) {
      $tabular = $this->Tabular_model->get_all(array('id' => $this->uid));
      $this->data['ancestry_depth'] = $tabular[0]->ancestry_depth;
      $this->data['id'] = $this->uid;
      $this->data['type'] = self::$id;

      $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
              array(
                  'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                  'tabulars.year' => $tabular[0]->year,
                  'tabulars.ref_code LIKE' => '%' . $tabular[0]->ref_code . '.%',
                  'tabulars.type' => 'kinerja-' . self::$id));

      $this->load->model('Data_source_model');
      $this->data['data_sources'] = $this->get_list($this->Data_source_model->get_all(array('sub_district_id' => $this->get_login_active_sub_district_id())));

      $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id] . ' ' . $tabular[0]->name . ' Tahun ' . $tabular[0]->year;
      $this->load->view('layout/sub_district', $this->data);
    } else {
      $update = $this->Tabular_model->save_all($post);
      $this->error_message('update', $update);
      redirect('sub_district/tabular_performance/view/' . self::$id . '/' . $this->uid);
    }
  }

}

?>