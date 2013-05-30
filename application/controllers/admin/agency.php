<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Agency extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Agency_model');
  }

  public function index() {
    $this->data['title'] = 'Data Institusi';
    $this->data['agencies'] = $this->Agency_model->get_all(
            $this->get_search_params(array('agencies.name')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Agency_model->get_all(
            $this->get_search_params(array('agencies.name')), TRUE);

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
    $agency = $this->Agency_model->get_all(array('agencies.id' => self::$id));
    $this->data['agency'] = $agency[0];
    $this->data['title'] = 'Detail Institusi ' . $agency[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('agency')) {
      $save = $this->Agency_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/agency');
    } else {
      $this->data['title'] = 'Tambah Institusi';
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
      $save = $this->Agency_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/agency');
    } else {
      if (!empty(self::$id)) {
        $agency = $this->Agency_model->get_all(array('agencies.id' => self::$id));
        $this->set_update_id($agency[0]->id);
        $this->data['id'] = self::$id;
        $this->data['agency'] = $agency[0];
        $this->data['title'] = 'Edit Institusi ' . $agency[0]->name;
        $this->load->model('Sub_district_model');
        $this->data['sub_district_list'] = $this->get_list($this->Sub_district_model->get_all());
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/agency');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Agency_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/agency');
  }

}

?>