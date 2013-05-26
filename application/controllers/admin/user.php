<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class User extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('User_model', '', TRUE);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function index() {
    $this->data['title'] = 'Data User';
    $this->data['users'] = $this->User_model->get_by_under_role_level(
            $this->get_login_active_id(),
            $this->get_search_params(array('users.name')),
            FALSE, 
            self::$limit, 
            $this->get_offset_from_segment());
    
    $count = $this->User_model->get_by_under_role_level(
            $this->get_login_active_id(),
            $this->get_search_params(array('users.name')),
            TRUE);
    
    $config = $this->set_before_pagination($count, $this->get_suffix_params());
    $this->pagination->initialize($config);
    $this->data['pagination'] = $this->set_after_pagination();
    $this->data['offset'] = $this->get_offset_from_segment();
    
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function view(){
    $user = $this->User_model->get_user_by_id(self::$id);
    $this->data['user'] = $user[0];
    $this->data['title'] = 'Detail User '.$user[0]->name;
    
    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $register = $this->User_model->register($this->input->post());
      $this->error_message('insert', $register);
      redirect('admin/user');
    } else {
      $this->data['title'] = 'Tambah User';
      $this->load->view('layout/admin', $this->data);
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * @param integer $id
   */
  public function edit($id = NULL) {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $update = $this->User_model->update($this->input->post());
      $this->error_message('update', $update);
      redirect('admin/user');
    } else {
      $user = $this->db->get_where('users', array('username' => $this->uri->segment(4)))->result();
      $this->data['user'] = $user[0];
      $this->data['title'] = 'Edit User Account ' . $user[0]->name;
      $this->load->view('layout/admin', $this->data);
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   * 
   * Description :
   * This function load admin user edit account page.
   */
  public function edit_account() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $update = $this->User_model->update($this->input->post());
      $this->error_message('update', $update);
      redirect('admin/user');
    } else {
      $user = $this->db->get_where('users', array('id' => $this->get_login_active_id()))->result();
      $this->data['user'] = $user[0];
      $this->data['title'] = 'Edit User Account ' . $user[0]->name;
      $this->load->view('layout/admin', $this->data);
    }
  }

}

?>