<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Role extends Admin_Controller {
   public function __construct() {
    parent::__construct();
    $this->load->model('Role_model');
  }

  public function index() {
    $this->data['title'] = 'Data User Role';
    $this->data['roles'] = $this->Role_model->get_all(
            $this->get_search_params(array('roles.name')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Role_model->get_all(
            $this->get_search_params(array('roles.name')), TRUE);

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
    $role = $this->Role_model->get_all(array('id' => self::$id));
    $this->data['role'] = $role[0];
    $this->data['title'] = 'Detail User Role ' . $role[0]->name;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('name_validation')) {
      $save = $this->Role_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/role');
    } else {
      $this->data['title'] = 'Tambah User Role';
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
      $save = $this->Role_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/role');
    } else {
      if (!empty(self::$id)) {
        $role = $this->Role_model->get_all(array('id' => self::$id));
        $this->set_update_id($role[0]->id);
        $this->data['id'] = self::$id;
        $this->data['role'] = $role[0];
        $this->data['title'] = 'Edit User Role ' . $role[0]->name;
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/role');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Role_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/role');
  }

}
?>