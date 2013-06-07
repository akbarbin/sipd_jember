<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Master_tabular_general extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Master_tabular_model');
  }

  public function index() {
    $this->data['title'] = 'Data Umum';
    $this->data['master_tabulars'] = $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ancestry_depth <' => 2,
                'master_tabulars.type' => 'umum'));
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function view() {
    $master_tabular = $this->Master_tabular_model->get_all(array('id' => self::$id));
    $this->data['ancestry_depth'] = $master_tabular[0]->ancestry_depth;

    $this->data['master_tabulars'] = $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ref_code LIKE' => $master_tabular[0]->ref_code . '.%',
                'master_tabulars.type' => 'umum'));

    $this->data['title'] = 'Data Umum ' . $master_tabular[0]->name;
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $data = array_merge($this->input->post(), array('type' => 'umum'));
      $save = $this->Master_tabular_model->save($this->set_data_before_update($data));
      $this->error_message('insert', $save);
      redirect('admin/master_tabular_general');
    } else {
      $this->data['title'] = 'Tambah Umum';
      $this->data['parent_id'] = self::$id;
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
      redirect('admin/master_tabular_general');
    } else {
      if (!empty(self::$id)) {
        $master_tabular = $this->Master_tabular_model->get_all(array('id' => self::$id));
        $this->set_update_id($master_tabular[0]->id);
        $this->data['id'] = self::$id;
        $this->data['master_tabular'] = $master_tabular[0];
        $this->data['title'] = 'Edit Umum ' . $master_tabular[0]->name;
        $this->load->model('Unit_model');
        $this->data['unit_list'] = $this->get_list($this->Unit_model->get_all());
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/master_tabular_general');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Master_tabular_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/master_tabular_general');
  }

  public function generate() {
    $post = $this->input->post();
    if (!empty($post)) {
      $this->load->model('Tabular_model');
      $generate = $this->Tabular_model->generate($post['year'], array('type' => 'umum'));
      $this->error_message('insert', $generate);
      redirect('admin/master_tabular_general');
    } else {
      $start = date('Y') - 10;
      $end = date('Y') + 10;
      for ($i = $start; $i <= $end; $i++) {
        $this->data['years'][$i] = $i;
      }
      $this->data['year'] = array(date('Y'));

      $this->data['title'] = 'Generate Data Umum Kecamatan';
      $this->load->view('layout/admin', $this->data);
    }
  }

}

?>