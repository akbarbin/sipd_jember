<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Public Controller use to add all function used by guest user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Public_Controller extends App_Controller { 
  
  public function __construct() {
    parent::__construct();
    
    /**
     * @author Mahendri Winata <mahen.0112@gmail.com>
     * 
     * Description :
     * Check User login status
     */
    if ($this->get_login_status() && ($this->router->class == 'user' && $this->router->method == 'login')) {
      redirect('admin/dashboard');
    }
    
    $this->data['top_menus']['umum'] = $this->__get_top_menu('umum');
    $this->data['top_menus']['profil'] = $this->__get_top_menu('profil');
    $this->data['top_menus']['kinerja'] = $this->__get_top_menu('kinerja%', 3);
    $this->data['sidebar_menus'] = $this->__get_sidebar_menu();
    $this->data['sub_districts'] = $this->__get_sub_district();
  }

  private function __get_top_menu($type = NULL, $level = 2) {
    $this->load->model('Master_tabular_model');
    $menus =  $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ancestry_depth <' => $level,
                'master_tabulars.type LIKE' => $type));
    $output = array();
    foreach ($menus as $key => $menu){
      if($menu->ancestry_depth == 0){
        $output[$key] = $menu;
        $output[$key]->Children = $this->__get_child($menus, $menu->id);
        if($level == 3){
          foreach ($output[$key]['Children'] as $k => $value) {
            $output[$key]->Children[$k]->Children = $this->__get_child($menus, $value->id);
          }
        }
      }
    }
    return $output;
  }
  
  private function __get_child($data = array(), $parent_id = NULL){
    $output = array();
    foreach ($data as $key => $value) {
      if($value->parent_id == $parent_id){
        $output[] = $value;
      }
    }
    return $output;
  }

  private function __get_sidebar_menu() {
    $this->load->model('Master_tabular_model');
    return $this->Master_tabular_model->get_ancestry_depth(
            array(
                'master_tabulars.ancestry_depth' => 0,
                'master_tabulars.type' => 'profil'));
  }
  
  private function __get_sub_district(){
    $this->load->model('Sub_district_model');
    return $this->Sub_district_model->get_all();
  }
}

?>