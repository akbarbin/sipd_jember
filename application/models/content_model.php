<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class Content_model extends App_Model {

  var $table = 'contents';

  function __construct() {
    parent::__construct();
  }

}

?>