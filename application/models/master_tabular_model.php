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

}

?>