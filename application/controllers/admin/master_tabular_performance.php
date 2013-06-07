<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Master_tabular_performance extends Admin_Controller {

  private $uid;
  private $type = array(
      'kesejahteraan-masyarakat' => 'Aspek Kesejahteraan Masyarakat',
      'pelayanan-umum' => 'Aspek Pelayanan Umum',
      'daya-saing' => 'Aspek Daya Saing'
  );

  public function __construct() {
    parent::__construct();
    $this->load->model('Master_tabular_model');
    $this->uid = $this->uri->segment(5);

    if (!isset($this->type[self::$id])) {
      $this->error_message('redirect', FALSE);
      redirect('admin/dashboard');
    }
  }

  public function index() {
    $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id];
    $this->data['type'] = self::$id;
    $this->data['master_tabulars'] = $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ancestry_depth <' => 2,
                'master_tabulars.type' => 'kinerja-' . self::$id));
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function view() {
    $master_tabular = $this->Master_tabular_model->get_all(array('id' => $this->uid));
    $this->data['ancestry_depth'] = $master_tabular[0]->ancestry_depth;

    $this->data['master_tabulars'] = $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ref_code LIKE' => $master_tabular[0]->ref_code . '.%',
                'master_tabulars.type' => 'kinerja-' . self::$id));

    $this->data['title'] = 'Data Kinerja ' . $this->type[self::$id] . ' ' . $master_tabular[0]->name;
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $data = array_merge($this->input->post(), array('type' => 'kinerja-' . self::$id));
      $save = $this->Master_tabular_model->save($this->set_data_before_update($data));
      $this->error_message('insert', $save);
      redirect('admin/master_tabular_performance/' . self::$id);
    } else {
      $this->data['title'] = 'Tambah Kinerja ' . $this->type[self::$id];
      $this->data['type'] = self::$id;
      $this->data['parent_id'] = $this->uid;
      $this->load->model('Unit_model');
      $this->data['unit_list'] = $this->get_list($this->Unit_model->get_all());
      $this->load->view('layout/admin', $this->data);
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param integer $id
   */
  public function edit() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $save = $this->Master_tabular_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/master_tabular_performance/' . self::$id);
    } else {
      if (!empty($this->uid)) {
        $master_tabular = $this->Master_tabular_model->get_all(array('id' => $this->uid));
        $this->set_update_id($master_tabular[0]->id);
        $this->data['id'] = $this->uid;
        $this->data['type'] = self::$id;
        $this->data['master_tabular'] = $master_tabular[0];
        $this->data['title'] = 'Edit Kinerja ' . $this->type[self::$id] . ' ' . $master_tabular[0]->name;
        $this->load->model('Unit_model');
        $this->data['unit_list'] = $this->get_list($this->Unit_model->get_all());
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/master_tabular_performance/' . self::$id);
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Master_tabular_model->remove($this->uid);
    $this->error_message('delete', $delete);
    redirect('admin/master_tabular_performance/'.self::$id);
  }

  public function generate() {
    $post = $this->input->post();
    if (!empty($post)) {
      $this->load->model('Tabular_model');
      $generate = $this->Tabular_model->generate($post['year'], array('type' => self::$id));
      $this->error_message('insert', $generate);
      redirect('admin/master_tabular_performance/'.self::$id);
    } else {
      $start = date('Y') - 10;
      $end = date('Y') + 10;
      for ($i = $start; $i <= $end; $i++) {
        $this->data['years'][$i] = $i;
      }
      $this->data['year'] = array(date('Y'));

      $this->data['title'] = 'Generate Kinerja ' . $this->type[self::$id] . ' Kecamatan';
      $this->load->view('layout/admin', $this->data);
    }
  }

}

?>