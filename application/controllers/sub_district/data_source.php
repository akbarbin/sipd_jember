<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Data_source extends Sub_District_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Data_source_model');
  }

  public function index() {
    $this->data['title'] = 'Data Sumber Data';
    $conditions = array_merge($this->get_search_params(array('data_sources.name')), array('data_sources.sub_district_id' => $this->get_login_active_sub_district_id()));
    $this->data['data_sources'] = $this->Data_source_model->get_all(
            $conditions, FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Data_source_model->get_all(
            $conditions, TRUE);

    $config = $this->set_before_pagination($count, $this->get_suffix_params());
    $this->pagination->initialize($config);
    $this->data['pagination'] = $this->set_after_pagination();
    $this->data['offset'] = $this->get_offset_from_segment();

    $this->load->view('layout/sub_district', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function view() {
    $data_source = $this->Data_source_model->get_all(array('data_sources.id' => self::$id));
    $this->data['data_source'] = $data_source[0];
    $this->data['title'] = 'Detail Sumber Data ' . $data_source[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $conditions = array_merge($this->input->post(), array('sub_district_id' => $this->get_login_active_sub_district_id()));
      $save = $this->Data_source_model->save($this->set_data_before_update($conditions));
      $this->error_message('insert', $save);
      redirect('sub_district/data_source');
    } else {
      $this->data['title'] = 'Tambah Sumber Data';
      $this->load->view('layout/sub_district', $this->data);
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
      $save = $this->Data_source_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('sub_district/data_source');
    } else {
      if (!empty(self::$id)) {
        $data_source = $this->Data_source_model->get_all(array('data_sources.id' => self::$id));
        $this->set_update_id($data_source[0]->id);
        $this->data['id'] = self::$id;
        $this->data['data_source'] = $data_source[0];
        $this->data['title'] = 'Edit Sumber Data ' . $data_source[0]->name;
        $this->load->view('layout/sub_district', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('sub_district/data_source');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Data_source_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('sub_district/data_source');
  }

}

?>