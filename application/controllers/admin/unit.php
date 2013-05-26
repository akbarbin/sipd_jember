<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Unit extends Admin_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->load->model('Unit_model');
  }
  
  public function index(){
    $this->data['title'] = 'Data Satuan';
    $this->data['units'] = $this->Unit_model->get_all(
            $this->get_search_params(array('units.name')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Unit_model->get_all(
            $this->get_search_params(array('units.name')), TRUE);

    $config = $this->set_before_pagination($count, $this->get_suffix_params());
    $this->pagination->initialize($config);
    $this->data['pagination'] = $this->set_after_pagination();
    $this->data['offset'] = $this->get_offset_from_segment();

    $this->load->view('layout/admin', $this->data);
  }
  
  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function view() {
    $unit = $this->Unit_model->get_unit_by_id(self::$id);
    $this->data['unit'] = $unit[0];
    $this->data['title'] = 'Detail Satuan ' . $unit[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $save = $this->Unit_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/unit');
    } else {
      $this->data['title'] = 'Tambah Satuan';
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
    if ($this->form_validation->run('user/edit')) {
      $save = $this->User_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/unit');
    } else {
      $unit = $this->Unit_model->get_unit_by_id(self::$id);
      $this->set_update_id($unit[0]->id);
      $this->data['id'] = self::$id;
      $this->data['user'] = $unit[0];
      $this->data['title'] = 'Edit Satuan ' . $unit[0]->name;
      $this->load->view('layout/admin', $this->data);
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Unit_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/unit');
  }  
}
?>