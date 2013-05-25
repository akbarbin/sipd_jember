<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class Data_source_model extends App_Model {

  public $table = 'data_sources';

  function __construct() {
    parent::__construct();
  }

}

?>