<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class History_model extends App_Model {

  public $table = 'histories';

  function __construct() {
    parent::__construct();
  }
  
}

?>