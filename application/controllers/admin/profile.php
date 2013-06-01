<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Profile extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Profile_model');
  }

  public function index() {
    $this->data['title'] = 'Data Profile';
    $this->data['profiles'] = $this->Profile_model->get_all(
            $this->get_search_params(array('profiles.title')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Profile_model->get_all(
            $this->get_search_params(array('profiles.title')), TRUE);

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
    $profile = $this->Profile_model->get_all(array('id' => self::$id));
    $this->data['profile'] = $profile[0];
    $this->data['title'] = 'Detail Profile ' . $profile[0]->title;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run()) {
      $save = $this->Profile_model->save($this->set_data_before_update($this->input->post()));
      $this->error_message('insert', $save);
      redirect('admin/profile');
    } else {
      $this->data['title'] = 'Tambah Profile';
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
    if ($this->form_validation->run('profile/edit')) {
      $save = $this->Profile_model->save($this->set_data_before_update($this->input->post()), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/profile');
    } else {
      if (!empty(self::$id)) {
        $profile = $this->Profile_model->get_all(array('id' => self::$id));
        $this->set_update_id($profile[0]->id);
        $this->data['id'] = self::$id;
        $this->data['profile'] = $profile[0];
        $this->data['title'] = 'Edit Profile ' . $profile[0]->title;
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/profile');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Profile_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/profile');
  }

}

?>