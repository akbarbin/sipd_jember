<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Instance extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Instance_model');
  }

  public function index() {
    $this->data['title'] = 'Data Instansi';
    $this->data['instances'] = $this->Instance_model->get_all(
            $this->get_search_params(array('instances.name')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Instance_model->get_all(
            $this->get_search_params(array('instances.name')), TRUE);

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
    $instance = $this->Instance_model->get_all(array('instances.id' => self::$id));
    $this->data['instance'] = $instance[0];
    $this->data['title'] = 'Detail Instansi ' . $instance[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('instance')) {
      $save = $this->Instance_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/instance');
    } else {
      $this->data['title'] = 'Tambah Instansi';
      $this->load->model('Sub_district_model');
      $this->data['sub_district_list'] = $this->get_list($this->Sub_district_model->get_all());
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
      $save = $this->Instance_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/instance');
    } else {
      if (!empty(self::$id)) {
        $instance = $this->Instance_model->get_all(array('instances.id' => self::$id));
        $this->set_update_id($instance[0]->id);
        $this->data['id'] = self::$id;
        $this->data['instance'] = $instance[0];
        $this->data['title'] = 'Edit Instansi ' . $instance[0]->name;
        $this->load->model('Sub_district_model');
        $this->data['sub_district_list'] = $this->get_list($this->Sub_district_model->get_all());
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/instance');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Instance_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/instance');
  }

}

?>