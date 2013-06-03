<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Image extends Admin_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Image_model');
  }

  public function index() {
    $this->data['title'] = 'Data Gambar';
    $this->data['images'] = $this->Image_model->get_all(
            $this->get_search_params(array('images.title')), FALSE, self::$limit, $this->get_offset_from_segment());

    $count = $this->Image_model->get_all(
            $this->get_search_params(array('images.title')), TRUE);

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
    $image = $this->Image_model->get_all(array('id' => self::$id));
    $this->data['image'] = $image[0];
    $this->data['title'] = 'Detail Image ' . $image[0]->title;

    $this->load->view('layout/admin', $this->data);
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function add() {
    $this->load->library('form_validation');
    if ($this->form_validation->run('profile')) {
      $post = $this->input->post();
      $post['image'] = $this->upload_image();
      $post['user_id'] = $this->get_login_active_id();
      $save = $this->Image_model->save($this->set_data_before_update($post));
      $this->error_message('insert', $save);
      redirect('admin/image');
    } else {
      $this->data['title'] = 'Tambah Gambar';
      $this->load->model('Profile_model');
      $this->data['profile_list'] = $this->get_list_title($this->Profile_model->get_all());
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
    if ($this->form_validation->run('profile')) {
      $post = $this->input->post();
      $image = $this->upload_image();
      if(!empty($image)){
        $post['image'] = $image;
      }
      $save = $this->Image_model->save($this->set_data_before_update($post), self::$update_id);
      $this->error_message('update', $save);
      redirect('admin/image');
    } else {
      if (!empty(self::$id)) {
        $image = $this->Image_model->get_all(array('id' => self::$id));
        $this->set_update_id($image[0]->id);
        $this->data['id'] = self::$id;
        $this->data['image'] = $image[0];
        $this->data['title'] = 'Edit Image ' . $image[0]->title;
        $this->load->model('Profile_model');
        $this->data['profile_list'] = $this->get_list_title($this->Profile_model->get_all());
        $this->load->view('layout/admin', $this->data);
      } else {
        $this->error_message('redirect', FALSE);
        redirect('admin/image');
      }
    }
  }

  /**
   * @author Mahendri Winata <mahen.0112@gmail.com>
   */
  public function delete() {
    $delete = $this->Image_model->remove(self::$id);
    $this->error_message('delete', $delete);
    redirect('admin/image');
  }

}

?>