<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Sub_district extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Sub_district_model');
  }

  public function index() {
    $this->data['title'] = 'Data Kecamatan';
    $this->data['sub_districts'] = $this->Sub_district_model->get_all(
            $this->get_search_params(array('sub_districts.name')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Sub_district_model->get_all(
            $this->get_search_params(array('sub_districts.name')), TRUE);

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
    $sub_district = $this->Sub_district_model->get_all(array('id' => self::$id));
    $this->data['sub_district'] = $sub_district[0];
    $this->data['title'] = 'Detail Kecamatan ' . $sub_district[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $save = $this->Sub_district_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/sub_district');
    } else {
      $this->data['title'] = 'Tambah Kecamatan';
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
      $save = $this->Sub_district_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/sub_district');
    } else {
      if (!empty(self::$id)) {
        $sub_district = $this->Sub_district_model->get_all(array('id' => self::$id));
        $this->set_update_id($sub_district[0]->id);
        $this->data['id'] = self::$id;
        $this->data['sub_district'] = $sub_district[0];
        $this->data['title'] = 'Edit Satuan ' . $sub_district[0]->name;
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/sub_district');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Sub_district_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/sub_district');
  }

}

?>