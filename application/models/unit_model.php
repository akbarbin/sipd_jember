<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class Unit_model extends App_Model {

  public $table = 'units';

  function __construct() {
    parent::__construct();
  }

}

?>