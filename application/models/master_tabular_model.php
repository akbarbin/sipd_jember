<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class Master_tabular_model extends App_Model {

  public $table = 'master_tabulars';

  function __construct() {
    parent::__construct();
  }
  
  function get_sidebar_menu(){
    $this->db->select('id, name, ancestry_depth')
            ->from($this->table)
            ->where('ancestry_depth <', 2)
            ->order_by('ref_code');
    $menus = $this->db->get()->result();
    return $menus;
  }

}

?>